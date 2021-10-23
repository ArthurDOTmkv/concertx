<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepresentationPlace extends Model
{
    public function place()
    {
        return $this->belongsTo('App\Place');
    }
    
    public function representation()
    {
        return $this->belongsTo('App\Representation');
    }
}
