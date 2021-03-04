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
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        $caID = null;
        $gID = "no";

        return view('product/product',['products' => $products, 
            'groups' => $groups, 'catagories' => $catagories, 'caID' => $caID, 'items_in_cart'=>$items_in_cart, 'gID' => $gID]);
    }

    public function searchProduct(request $request){
        $products = DB::table('type')->get();
        $groups = DB :: table('group')->get();
        $catagories = DB :: table('catagories')->get();
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        $caID = $request->Input('caID');
        $gID ="no";
        return view('product/product',['products' => $products, 
            'groups' => $groups, 'catagories' => $catagories, 'caID' => $caID, 'gID' => $gID, 'items_in_cart'=>$items_in_cart]);
    }

    public function searchGroup(request $request){
        $products = DB::table('type')->get();
        $groups = DB :: table('group')->get();
        $catagories = DB :: table('catagories')->get();
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        $gID = $request->Input('gID');
        $caID = "no";
        $products_search = DB::table('group')
        ->join('catagories','group.gID','=','catagories.gID')
        ->join('type','catagories.caID','=','type.caID')
        ->where(['group.gID'=>$gID])->get(); 

        return view('product/product',['products' => $products, 
            'groups' => $groups, 'catagories' => $catagories, 'caID' => $caID, 'gID' => $gID, 'items_in_cart'=>$items_in_cart,
            'products_search' => $products_search]);
    }

    public function productDetail(request $request){
        $tID = $request->Input('tID');
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        $manu = DB::table('type')->join('catagories','type.caID','=','catagories.caID')
        ->join('group','catagories.gID','=','group.gID')->where(['type.tID'=>$tID])->get();
        $data = DB::table('type')->where(['type.tID'=>$tID])->get();

        $products = DB::table('products')->where(['products.tID'=>$tID])->get();
        $details = DB::table('details')->get();
        $proSize = $products->groupBy('pSize');

        return view('product/product-detail',['manu' => $manu, 'data' => $data, 'proSize' => $proSize,
        'tID'=>$tID, 'items_in_cart'=>$items_in_cart, 'products'=>$products, 'details'=>$details]);
    }
}
