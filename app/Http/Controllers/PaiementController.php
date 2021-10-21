<?php

namespace App\Http\Controllers;

use DateTime;
use App\Commande;
use App\Concert;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Redirection vers la page de concerts si tentative d'accéder à /paiement alors que le panier est vide
        if(Cart::count() <= 0)
        {
            return redirect()->route('concerts.index');
        }
        Stripe::setApiKey('sk_test_51IbU2DFyQMpZqbpyg7owK5RggOzsKuLK4ixxyD1pz1BpajU26hz5PQtbN5oiUKjiuPVmipDDcxh0X38AdyJOf7tz000JxPbITq');
        
        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),
            'currency' => 'eur',
            //'payment_method_types' => ['card'],
          ]);
        
        //Faire passer la clé secrète à une variable pour pouvoir l'utiliser dans le front
        $clientSecret = Arr::get($intent, "client_secret");
        
        return view('paiement.index', [
            "clientSecret" => $clientSecret
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Vérifier s'il y a des places dans le DB durant le paiement
        if($this->noSeats())
        {
            Session::flash('danger', 'Le nombre de places demandé n\'est plus disponible');
            return response()->json(['success' => false], 400);
        }
        //Récupération de l'objet de paiement dans la variable $data
        $data = $request->json()->all();
        //Stocker les données de paymentIntent dans le champ paymentIntentId de la Commande
        $commande = new Commande();
        $commande->paymentIntentId = $data['paymentIntent']['id'];
        $commande->montant = $data['paymentIntent']['amount'];
        $commande->paymentCreatedAt = (new DateTime())->setTimestamp($data['paymentIntent']['created'])->format('Y-m-d H:i:s');
        $concerts = [];
        $i = 0;
        foreach(Cart::content() as $concert)
        {
            $concerts['concert_' . $i][] = $concert->model->titre;
            $concerts['concert_' . $i][] = $concert->model->prix;
            $concerts['concert_' . $i][] = $concert->qty;
            $i++;
            
        }
        $commande->concerts = serialize($concerts);
        $commande->user_id = Auth()->user()->id;
        $commande->save();
        if($data['paymentIntent']['status'] === 'succeeded')
        {
            $this->majPlaces();
            Cart::destroy();
            Session::flash('success', 'Commande validée avec succès');
            return response()->json(['success' => 'Enregistrement validé']);
        }
        else
        {
            return response()->json(['error' => 'Enregistrement échoué']);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function paiementreussi()
    {
        return Session::has('success') ? view('paiement.paiementreussi') : redirect()->route('concerts.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    private function majPlaces()
    {
        foreach(Cart::content() as $obj)
        {
            //Récupération du produit avec l'id du model
            $concert = Concert::find($obj->model->id);       //Attribut propre au model et pas à la DB
            //MAJ du produit en fonction de la quantité choisie
            $concert->update(['places' => $concert->places - $obj->qty]);
        }
    }
    
    private function noSeats()
    {
        foreach(Cart::content() as $obj)
        {
            $concert = Concert::find($obj->model->id);
            
            /*
             * Si les places entrées sont inférieures à la quantité demandée
             * return false => sortir erreur
             * Sinon, procéder au paiement
             */
            if($concert->places < $obj->qty)
            {
                return true;
            }
        }
        return false;
    }
}
