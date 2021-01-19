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
    function getTotalOrders() {
        $orders = DB::select('SELECT * FROM orders');
        $num = count($orders);
        ++$num; // add 1;
        $len = strlen($num);
        for($i=$len; $i< 4; ++$i) {
            $num = '0'.$num;
        }
        $oID = 'QT'.$num;
        return $oID;
    }    

    function getTotalOrdersDetails() {
        $details = DB::select('SELECT * FROM details');
        $num = count($details);
        ++$num; // add 1;
        $len = strlen($num);
        for($i=$len; $i< 4; ++$i) {
            $num = '0'.$num;
        }
        $dID = 'DT'.$num;
        return $dID;
    } 

    public function cart(request $request)
    {
        $cID=Auth::id(); 
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        $customer =  DB::table('customers')->where(['cID'=>$cID])->get();
        return view('cart',['items_in_cart'=>$items_in_cart,'customer'=>$customer]);
    }

    public function cartDelete(request $request)
    {
        $pID = $request->input('pID');
        if($pID) {
            $cart = session()->get('cart');
            if(isset($cart[$pID])) {
                unset($cart[$pID]);
                session()->put('cart', $cart);
            }
            return redirect('/cart');
        }
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
        $pImg = $product[0]->tImg;
        $pUnit = $product[0]->pUnit;


        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        $request->session()->forget('cart');
        print_r($cart);
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $pID => [
                        "tID" => $tID,
                        "pID" => $pID,
                        "pName" => $pName,
                        "quantity" => $qty,
                        "pBrand" => $pBrand,
                        "pSize" => $pSize,
                        "pThick" => $pThick,
                        "pImg" => $pImg,
                        "pUnit" => $pUnit
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
        $cart[$pID] = [
                "pID" => $pID,
                "pName" => $pName,
                "quantity" => $qty,
                "pBrand" => $pBrand,
                "pSize" => $pSize,
                "pThick" => $pThick,
                "pImg" => $pImg,
                "pUnit" => $pUnit
            ];
        session()->put('cart', $cart);
        return redirect('/product');

    }
    
    public function cartDelivery(request $request)
    {
        $oShipName = $request->input('name');
        $oShipAddress = $request->input('addr');
        $oShipPhone = $request->input('phone');  
        $cart = session()->get('cart');
        $cID=Auth::id();
        $cID=DB::table('customers')->where('cID', '=', $cID)->value('cID');
        $today = Carbon::today();        
        $oID=$this->getTotalOrders();

        DB::table('orders')->insert(
            ['oID' =>$oID,
            'cID' =>$cID,
            'oDate' =>$today,
            'oShipName' =>$oShipName,
            'oShipAddress' =>$oShipAddress,
            'oShipPhone' =>$oShipPhone,
            'oStatus' =>$oStatus]
        );

        foreach($cart as $item){
            $dID=$this->getTotalOrdersDetails();
            DB::table('details')->insert(
                ['dID' =>$dID,
                'oID' =>$oID,
                'pID' =>$item['pID'],
                'dQuantity' =>$item['quantity'],
                'dInStock'=>1]
            );
        }
        $request->session()->forget('cart');
        return redirect('/product');
    }

    public function cartSelf(request $request)
    {
        $oShipName = $request->input('name');
        $oShipAddress = "รับเอง";
        $oShipPhone = $request->input('phone');  
        $cart = session()->get('cart');
        $cID=Auth::id();
        $cID=DB::table('customers')->where('cID', '=', $cID)->value('cID');
        $today = Carbon::today();        
        $oID=$this->getTotalOrders();
        $oStatus=DB::table('status')->where('status', '=', "อยู่ในระหว่างการขอใบเสนอราคา")->value('status');
        
        DB::table('orders')->insert(
            ['oID' =>$oID,
            'cID' =>$cID,
            'oDate' =>$today,
            'oShipName' =>$oShipName,
            'oShipAddress' =>$oShipAddress,
            'oShipPhone' =>$oShipPhone,
            'oStatus' =>$oStatus]
        );

        foreach($cart as $item){
            $dID=$this->getTotalOrdersDetails();
            DB::table('details')->insert(
                ['dID' =>$dID,
                'oID' =>$oID,
                'pID' =>$item['pID'],
                'dQuantity' =>$item['quantity'],
                'dInStock'=>1]
            );
        }
        $request->session()->forget('cart');
        return redirect('/product');
    }

    public function cartUpdate(request $request)
    {
        
        $pID = $request->input('pID');
        $qty = $request->input('qty');        
        $cart = session()->get('cart');

        for($i = 0; $i < count($pID); $i++){
            $cart[$pID[$i]]['quantity'] = (int)$qty[$i];
            session()->put('cart', $cart);
        }
        return redirect('/cart');

    }


}
