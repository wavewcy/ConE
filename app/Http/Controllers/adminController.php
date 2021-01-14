<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function adminMenu(request $request)
    { 
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        return view('admin/admin',['items_in_cart'=>$items_in_cart]);
    }
}
