<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function showProduct(){
        $products = DB::table('type')->get();
        $groups = DB :: table('group')->get();
        $catagories = DB :: table('catagories')->get();
        $caID = null;
        return view('product/product',['products' => $products, 
            'groups' => $groups, 'catagories' => $catagories, 'caID' => $caID]);
    }

    public function searchProduct(request $request){
        $products = DB::table('type')->get();
        $groups = DB :: table('group')->get();
        $catagories = DB :: table('catagories')->get();
        $caID = $request->Input('caID');
        return view('product/product',['products' => $products, 
            'groups' => $groups, 'catagories' => $catagories, 'caID' => $caID]);
    }
}
