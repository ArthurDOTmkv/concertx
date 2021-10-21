<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function places()
    {
        $this->hasMany('App\Place');
    }
}
