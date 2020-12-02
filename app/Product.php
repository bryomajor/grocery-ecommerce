<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function flavor(){
        return $this->belongsTo('App\Flavor');
    }

    public function measurement(){
        return $this->belongsTo('App\Measurement');
    }
}
