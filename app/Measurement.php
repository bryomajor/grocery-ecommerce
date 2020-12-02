<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    private function products(){
        return $this->hasMany('App\Product');
    }
}
