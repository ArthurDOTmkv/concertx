<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{
    public function concerts()
    {
        return $this->belongsToMany('App\Concert');
    }
}
