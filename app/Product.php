<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function flavors(){
        return $this->belongsToMany('App\Flavor');
    }

    public function measurements(){
        return $this->belongsToMany('App\Measurement');
    }
}
