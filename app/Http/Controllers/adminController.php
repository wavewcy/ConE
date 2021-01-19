<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\App;
use PDF;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Carbon\Carbon;
use strtotime;

class adminController extends Controller
{
    public function adminMenu(request $request)
    { 
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

        return view('admin/admin',['items_in_cart'=>$items_in_cart, 'count1'=>$count1,
                    'details'=>$details, 'products'=>$products, 'orders'=>$orders, 'count2'=>$count2,
                    'count3'=>$count3, 'count'=>$count]);
    }

    public function quotation(request $request)
    { 
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        //$oID=$request->input('oID');
        $oID="QT0002";
        //$customer=DB::table('orders')->join('customers','orders.cID','=','customers.cID')->where('oID','=',$oID)->get();
        $order=DB::table('orders')->where('oID','=',$oID)->get();
        $oShipAddress=DB::table('orders')->where('oID','=',$oID)->value('oShipAddress');
        $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->get();
        if($oShipAddress=="รับเอง"){
            $haveCost=0;
        }else{
            $haveCost=1;
        }
        //print_r($order);

        return view('admin/quotation',['items_in_cart'=>$items_in_cart,'details'=>$details,'order'=>$order,'haveCost'=>$haveCost]);
          
    }

    public function createQuotation(request $request)
    { 
        $oID=$request->input('oID');
        $price = $request->input('price');
        $pID = $request->input('pID');
        $qty = $request->input('qty');
        $cost = $request->input('cost');
        $inStock = $request->input('inStock'); 
        $note = $request->input('note'); 
        $today = Carbon::today();    
        $oStatus=DB::table('status')->where('status', '=', "รอยืนยันใบเสนอราคา")->value('status');
        $amountVat = 0;
        $saler = Auth::name();
        
        for($i = 0; $i < count($pID); $i++){
            DB::table('details')->where('pID', $pID[$i])->where('oID',$oID)->update(['dPrice' => $price[$i], 'dInStock'=>$inStock[$i]]);
            $amountVat += $qty[$i]*$price[$i];
        }
        $amountVat += $cost;
        $vat = ($amountVat*7)/107;
        $amount = $amountVat-$vat;
        DB::table('orders')->where('oID',$oID)->update(['oShipCost'=>$cost,'oAmountVat'=>$amountVat,'oStatus'=>$oStatus,'oAmount'=>$amount,'oVat'=>$vat,'oNote'=>$note,'oDateQ'=>$today,'oAdmin'=>$saler]);
        
        $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',1)->get();
        $outOfStock = DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',0)->get();
        $orders =  DB::table('orders')->where('oID', '=', $oID)->get();
        $pdf = PDF::loadView('admin/QuotationPdf',['details'=>$details, 'orders'=>$orders, 'outOfStock'=>$outOfStock]);

        return $pdf->stream();
        
          
    }

}
