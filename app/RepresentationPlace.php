<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepresentationPlace extends Model
{
    public function places()
    {
        return $this->belongsTo('App\Place');
    }
    
    public function representaions()
    {
        $this->belongsToMany('App\Representation');
    }
}
