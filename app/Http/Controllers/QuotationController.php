<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class QuotationController extends Controller
{
    public function Qconfirm(){
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
                     'orders.oStatus'=>'อยู่ในระหว่างการขอใบเสนอราคา'])->count();
        $count2 =  DB::table('orders')->where(['orders.cID'=>$idCustomer,
                     'orders.oStatus'=>'รอยืนยันใบเสนอราคา'])->count();
        $count3 =  DB::table('orders')->where(['orders.cID'=>$idCustomer,
                     'orders.oStatus'=>'อยู่ในระหว่างการต่อรองราคา'])->count();
        $count4 =  DB::table('orders')->where('orders.cID','=',$idCustomer)
                    ->Where('orders.oStatus','=','รอชำระเงิน')->count();
        $count5 =  DB::table('orders')->where('orders.cID','=',$idCustomer)
                    ->Where('orders.oStatus','=','กำลังตรวจสอบการชำระเงิน')->count();
        $count = $count4 + $count5;
                    // print($count4);

        return view('customer/QuotationConfirm',['items_in_cart'=>$items_in_cart, 'count1'=>$count1,
                    'details'=>$details, 'products'=>$products, 'orders'=>$orders, 'count2'=>$count2,
                    'count3'=>$count3, 'count'=>$count]);
    }
}
