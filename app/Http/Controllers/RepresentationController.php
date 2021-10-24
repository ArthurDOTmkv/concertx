<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Place;
use Illuminate\Support\Facades\DB;

class RepresentationController extends Controller
{
    //
    public function index()
    {
        $places = collect();
        $results = DB::table('commandes_places')->where('representation_id',2)->get();
        foreach($results as $result){
            $places->push(Place::where('id',$result->place_id)->firstOrFail());
        }

        return view('representations.index', [
            'indisponible' => $places->toArray()
        ]);
    }
}
