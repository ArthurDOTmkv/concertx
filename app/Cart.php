<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'place_id', 'representation_id', 'prix', 'paymentIntentId','paymentCreatedAt'
    ];
}
