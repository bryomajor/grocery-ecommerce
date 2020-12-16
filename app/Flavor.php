<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
