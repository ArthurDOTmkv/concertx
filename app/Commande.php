<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    public function user()
    {
        //Une commande appartient à un seul utilisateur
        return $this->belongsTo('App\User');
    }
}
