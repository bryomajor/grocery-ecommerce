<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    private function products(){
        return $this->hasMany('App\Product');
    }
}
