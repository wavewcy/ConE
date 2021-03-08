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
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['cart']]);
    }

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

    public function reorder(request $request)
    {
        $oID = $request->input('oID');
        $details = DB::table('details')
        ->join('products','products.pID','=','details.pID')
        ->join('type','products.tID','=','type.tID')
        ->where(['oID'=>$oID])->get();        

        foreach($details as $detail){
            $pSize = $detail->pSize;
            $pThick = $detail->pThick;
            $pBrand = $detail->pBrand;
            $pUnit = $detail->pUnit;
            $qty = $detail->dQuantity;            
            $pID = $detail->pID;
            $pName = $detail->tName;
            $pImg = $detail->tImg;
            $tID = $detail->tID;

            $cart = session()->get('cart');
            $request->session()->forget('cart');

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
            }
            if(isset($cart[$pID])) {
                $cart[$pID]['quantity'] = $cart[$pID]['quantity']+$qty;
                session()->put('cart', $cart);
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
        }
        
        return redirect('/cart');
       
    }
    
    public function cartDelivery(request $request)
    {
        $oShipName = $request->input('name');
        $oShipAddress = $request->input('addr');
        $oShipPhone = $request->input('phone');  
        $cart = session()->get('cart');
        $cID=Auth::id();
        $cID=DB::table('customers')->where('cID', '=', $cID)->value('cID');
        $oStatus=DB::table('status')->where('status', '=', "อยู่ในระหว่างการขอใบเสนอราคา")->value('status');
        $today = Carbon::today();        
        $oID=$this->getTotalOrders();
        $exp = Carbon::parse($today)->addYear();

        DB::table('orders')->insert(
            ['oID' =>$oID,
            'cID' =>$cID,
            'oDate' =>$today,
            'oExp' =>$exp,
            'oShipName' =>$oShipName,
            'oShipAddress' =>$oShipAddress,
            'oShipPhone' =>$oShipPhone,
            'oStatus' =>$oStatus]
        );

        foreach($cart as $item){
            $dID=$this->getTotalOrdersDetails();
            $pPrice = DB::table('products')->where('pID', '=', $item['pID'])->value('pPrice');
            DB::table('details')->insert(
                ['dID' =>$dID,
                'oID' =>$oID,
                'pID' =>$item['pID'],
                'dQuantity' =>$item['quantity'],
                'dPrice' =>$pPrice,
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
        $exp = Carbon::parse($today)->addYear();
        
        DB::table('orders')->insert(
            ['oID' =>$oID,
            'cID' =>$cID,
            'oDate' =>$today,
            'oExp' =>$exp,
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

    public function history(){

        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }

        $idCustomer = Auth::id();
        $details =  DB::table('orders')->join('details','orders.oID','=','details.oID')
                    ->where(['orders.cID'=>$idCustomer])->get();
        $orders = $details->groupBy('oID');
        $products =  DB::table('products')->join('type','products.tID','=','type.tID')->get();

        $count1 =  DB::table('orders')->where(['orders.cID'=>$idCustomer,
                     'orders.oStatus'=>'คำสั่งซื้อสำเร็จแล้ว'])->count();
        $count2 =  DB::table('orders')->where(['orders.cID'=>$idCustomer,
                     'orders.oStatus'=>'ยกเลิกคำสั่งซื้อ'])->count();
        $count3 =  DB::table('orders')->where(['orders.cID'=>$idCustomer,
                     'orders.oStatus'=>'หมดอายุ'])->count();

        $count = $count1 + $count2 + $count3;

        return view('customer/history', ['items_in_cart'=>$items_in_cart, 'details'=>$details, 'products'=>$products,
                     'orders'=>$orders, 'count'=>$count]);
    }
// add data test
    public function forloop(){
        $i =0;
        while ($i<2000){
            $i++;
            DB::table('products')->insert(['pID'=>$i, 'tID'=> 'T0001']);
        }
    }


}
