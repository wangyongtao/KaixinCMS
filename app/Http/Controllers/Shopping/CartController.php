<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Watercart\Cart as CartModel;

class CartController extends Controller
{

    public function __constuct(){
        parent::__constuct();
    }

    public function showList(Request $request)
    {
        $data = [];

        return view('shoppingcart.cartlist', $data);
    }
}