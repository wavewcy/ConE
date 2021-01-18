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
        $cID=Auth::id(); 
        $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->get();
        //print_r($details);


        return view('admin/quotation',['items_in_cart'=>$items_in_cart,'details'=>$details,'oID'=>$oID]);
          
    }

    public function createQuotation(request $request)
    { 
        $oID=$request->input('oID');
        $price = $request->input('price');
        $pID = $request->input('pID');
        $qty = $request->input('qty');
        $cost = $request->input('cost');
        $inStock = $request->input('inStock');   
        $oStatus=DB::table('status')->where('status', '=', "รอยืนยันใบเสนอราคา")->value('status');
        $amount = 0;

        print_r($inStock);
        
        for($i = 0; $i < count($pID); $i++){
            DB::table('details')->where('pID', $pID[$i])->where('oID',$oID)->update(['dPrice' => $price[$i], 'dInStock'=>$inStock[$i]]);
            $amount += $qty[$i]*$price[$i];
        }
        $amount += $cost;
        DB::table('orders')->where('oID',$oID)->update(['oShipCost'=>$cost,'oAmount'=>$amount,'oStatus'=>$oStatus]);
        
          
    }

    public function generatePdf(request $request)
    {
        // จะใส่หมายเหตุ??
        // จะเพิ่มเบอร์คนขาย??
        // วันที่ในใบเสนอราคาเหมือนกันหมด??
        
        // $oID=$request->input('oID');
        $oID = "QT0005";
        $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
                    ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->get();
        $orders =  DB::table('orders')->where('oID', '=', $oID)->get();
        $pdf = PDF::loadView('admin/QuotationPdf',['details'=>$details, 'orders'=>$orders]);

        return $pdf->stream();
    }

}
