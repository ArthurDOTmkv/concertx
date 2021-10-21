<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    //Champs modifiables
    protected $fillable = ['places'];
    
    public function getPrix()
    {
        $prix = $this->prix / 100;
        
        /*
         * Prix - Décimales - Séparateur - Espace entre les milliers
         */
        return number_format($prix, 2, ',', ' ') . " €";
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Categorie');
    }
    
    public function artistes()
    {
        return $this->belongsToMany('App\Artiste');
    }
    
    public function represenations()
    {
        return $this->hasMany('App\Represenation');
    }
}
