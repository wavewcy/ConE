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

        return view('cart',['products' => $products]);
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
        // public function addToCart($id)
        // $product = products::find($id);
        $tID = $_GET['tID'];
        $qty = $_GET['qty'];
        $product = DB::Select('Select * From product join type using (tID) where tID=? and pBrand=? and pSize=? and pThick=? and pUnit=?',[$tID,$pBrand,$pSize,$pThick,$pUnit]);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "tID" => $pID,
                        "tName" => $product->tName,
                        "quantity" => $qty,
                        "pBrand" => $product->pBrand,
                        "pThick" => $product->pSize,
                        "pThick" => $product->pThick
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity']+$qty;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }





}
