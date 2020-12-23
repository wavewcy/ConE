<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Carbon\Carbon;
use strtotime;

class ordersController extends Controller
{
    public function cart(request $request)
    {
        // $cID=Auth::id();
        $cID=1;
        $products = DB::Select('Select * From orders join details using (oID) join products using (pID) join type using (tID) where ?=cID and oStatus="อยู่ในตะกร้า"',[$cID]);
        $items_in_cart = count(session()->get('cart'));
        return view('cart',['products' => $products, 'items_in_cart'=>$items_in_cart]);
    }

    public function cartDelete(request $request)
    {
        // $cID=Auth::id();
        $cID=1;
        $pID = $_GET['pID'];
        DB::table('details')
        ->join('orders', 'details.oID', '=', 'orders.oID')
        ->where(['pID'=>$pID, 'cID'=>$cID, 'oStatus'=>"อยู่ในตะกร้า"])->delete();

        return redirect()->back();
    }

    public function cartUpdate(request $request)
    {

    }

    public function addToCart(request $request)
    {
        $pSize = $_POST['size'];
        $pThick = $_POST['thick'];
        $pBrand = $_POST['brand'];
        $pUnit = implode(' ', array_slice(explode(' ', $_POST['unit']), 0, 1));
        $qty = $_POST['qty'];
        $tID = $_POST['tID'];
        $product = DB::Select('Select * From products join type using (tID) where tID=? and pBrand=? and pSize=? and pThick=? and pUnit=?',[$tID,$pBrand,$pSize,$pThick,$pUnit]);
        $pID = $product[0]->pID;
        $pName = $product[0]->tName;
        $pBrand = $product[0]->pBrand;
        $pSize = $product[0]->pSize;
        $pThick = $product[0]->pThick;

        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        print_r($cart);
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $pID => [
                        "pID" => $pID,
                        "pName" => $pName,
                        "quantity" => $qty,
                        "pBrand" => $pBrand,
                        "pSize" => $pSize,
                        "pThick" => $pThick
                    ]
            ];
            session()->put('cart', $cart);
            return redirect('/product');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$pID])) {
            $cart[$pID]['quantity'] = $cart[$pID]['quantity']+$qty;
            session()->put('cart', $cart);
            return redirect('/product');
        }
        $cart = [
            $pID => [
                "pID" => $pID,
                "pName" => $pName,
                "quantity" => $qty,
                "pBrand" => $pBrand,
                "pSize" => $pSize,
                "pThick" => $pThick
            ]
         ];
        session()->put('cart', $cart);
        return redirect('/product');
    }





}
