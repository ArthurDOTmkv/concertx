<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function concerts()
    {
        return $this->belongsToMany('App\Concert');
    }
}
