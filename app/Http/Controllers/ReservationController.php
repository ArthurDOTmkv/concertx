<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use Gloudemans\Shoppingcart\Facades\Cart;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->json()->all();
        $sieges = collect();
        foreach($data as $row){
            $sieges->push(Place::where('rangee','=', $row['x'])->where('colonne', '=', $row['y'])->firstOrFail());
        }

        return $sieges;
    }
}
