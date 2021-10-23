<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\RepresentationPlace;
use App\Place;

class RepresentationController extends Controller
{
    //
    public function index()
    {
        $places = collect();
        $results = RepresentationPlace::where('representation_id',2)->get();
        foreach($results as $result){
            $places->push(Place::where('id',$result->place_id)->firstOrFail());
        }

        return view('representations.index', [
            'indisponible' => $places->toArray()
        ]);
    }
}
