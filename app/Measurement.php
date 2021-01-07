<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
