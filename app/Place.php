<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function zones()
    {
        $this->belongsTo('App\Zone');
    }
    
}