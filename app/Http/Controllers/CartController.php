<?php

namespace App\Http\Controllers;

use App\Concert;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
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
        //Eviter les doublons
        $doublon = Cart::search(function($cartItem, $rowId) use ($request)
        {
            return $cartItem->id == $request->concert_id;
        });
        
        if($doublon->isNotEmpty())
        {
            return redirect()->route('concerts.index')->with('success', 'Les places ont déjà été ajoutées au panier');
        }
        
        //Ne passer que l'id en paramètre pour éviter de modifier les données à travers le front (prix, quantité, etc)
        $concert = Concert::find($request->concert_id);
        
        Cart::add($concert->id, $concert->titre, 1, $concert->prix)->associate('App\Concert');
        
        return redirect()->route('concerts.index')->with('success', 'Les places ont été ajoutées au panier');
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
    public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();
        
        $validater = Validator::make($request->all(), [
            'qty' => 'required|numeric|between:1,10',
        ]);
        if($validater->fails())
        {
            Session::flash('danger', 'ERROR');
            return response()->json(['error' => 'ERROR']);
        }
        
        if($data['qty'] > $data['places']){
            Session::flash('danger', 'Le nombre de places demandé est trop élevé. Places restantes : '. $data['places']);
            return response()->json(['error' => 'ERROR']);
        }
        
        Cart::update($rowId, $data['qty']);
        
        Session::flash('success', 'Le nombre de tickets est passé à ' . $data['qty']);
        
        return response()->json(['success' => 'La quantité a été mise à jour']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        
        return back()->with('success', 'Votre place a bien été retirée');
    }
}
