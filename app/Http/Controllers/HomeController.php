<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['home']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/product');
    }

    public function home()
    {
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }

        return view('home-02',['items_in_cart'=>$items_in_cart]);
    }
}
