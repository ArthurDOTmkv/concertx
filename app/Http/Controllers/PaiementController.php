<?php

namespace App\Http\Controllers;

use DateTime;
use App\Commande;
use App\Concert;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if(app('App\Http\Controllers\CartController')->count() <= 0)
        {
            return redirect()->route('concerts.index');
        }
        
        return view('paiement.index');
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
        $cart = Cart::where('user_id',Auth::id())->get();
        $description = '[';
        foreach($cart as $row){
            $description = $description.'{representation: ' . $row->representation_id . ', place: "' . app('App\Http\Controllers\CartController')->place($row->place_id) . '"},';
            DB::table('commandes_places')->insert([
                'place_id' => $row->place_id,
                'representation_id' => $row->representation_id
            ]);
        }
        $description = $description.']';
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'total' => app('App\Http\Controllers\CartController')->total(),
            'description' => $description
        ]);
        Cart::where('user_id',Auth::id())->delete();
        return \Redirect::route('paiement.reussi');
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
        return view('paiement.reussi');
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
    
}
