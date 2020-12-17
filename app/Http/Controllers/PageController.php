<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function checkout(){
        return view('pages.checkout');
    }
}

