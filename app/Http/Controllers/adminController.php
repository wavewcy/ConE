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
        return view('admin/admin',['items_in_cart'=>$items_in_cart]);
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
        
        for($i = 0; $i < count($pID); $i++){
            DB::table('details')->where('pID', $pID[$i])->where('oID',$oID)->update(['dPrice' => $price[$i], 'dInStock'=>$inStock[$i]]);
            $amountVat += $qty[$i]*$price[$i];
        }
        $amountVat += $cost;
        $vat = ($amountVat*7)/107;
        $amount = $amountVat-$vat;
        DB::table('orders')->where('oID',$oID)->update(['oShipCost'=>$cost,'oAmountVat'=>$amountVat,'oStatus'=>$oStatus,'oAmount'=>$amount,'oVat'=>$vat,'oNote'=>$note,'oDateQ'=>$today]);
        
        $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',1)->get();
        $outOfStock = DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',0)->get();
        $orders =  DB::table('orders')->where('oID', '=', $oID)->get();
        $pdf = PDF::loadView('admin/QuotationPdf',['details'=>$details, 'orders'=>$orders, 'outOfStock'=>$outOfStock]);

        return $pdf->stream();
        
          
    }

    public function ViewPdf(request $request){

        //เพิ่มตารางเก็บค่าชื่อ Admin ที่สร้างใบเสนอราคานั้นๆ 
        $oID=$request->input('oID');
        $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',1)->get();
        $outOfStock = DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',0)->get();
        $orders =  DB::table('orders')->where('oID', '=', $oID)->get();
        $pdf = PDF::loadView('admin/QuotationPdf',['details'=>$details, 'orders'=>$orders, 'outOfStock'=>$outOfStock]);

        return $pdf->stream();
    }

}
