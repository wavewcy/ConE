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

    function getTotalBargains() {
        $bargains = DB::select('SELECT * FROM bargains');
        $num = count($bargains);
        ++$num; // add 1;
        $len = strlen($num);
        for($i=$len; $i< 4; ++$i) {
            $num = '0'.$num;
        }
        $bID = 'BG'.$num;
        return $bID;
    } 

    public function adminMenu(request $request)
    { 
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        $idAdmin = Auth::id();

        $details =  DB::table('orders')->join('details','orders.oID','=','details.oID')
        ->join('customers','customers.cID','=','orders.cID')
        ->join('tier','tier.tierID','=','customers.tierID')
        ->where(['orders.oAdmin'=>$idAdmin])->get();

        $orders = $details->groupBy('oID');

        $allDetails =  DB::table('orders')->join('details','orders.oID','=','details.oID')
        ->join('customers','customers.cID','=','orders.cID')
        ->join('tier','tier.tierID','=','customers.tierID')
        ->reorder('customers.tierID', 'ASC')
        ->get();
        $allOrders = $allDetails->groupBy('oID');
        
        $products =  DB::table('products')->join('type','products.tID','=','type.tID')->get();

        $evidences = DB::table('evidences')->groupby('oID')->get();

        $count1 =  DB::table('orders')->where(['orders.oStatus'=>'อยู่ในระหว่างการขอใบเสนอราคา'])->count();
        $count2 =  DB::table('orders')->where(['orders.oAdmin'=>$idAdmin,
                     'orders.oStatus'=>'รอยืนยันใบเสนอราคา'])->count();
        $count3 =  DB::table('orders')->where(['orders.oAdmin'=>$idAdmin,
                     'orders.oStatus'=>'อยู่ในระหว่างการต่อรองราคา'])->count();
        $count4 =  DB::table('orders')->where('orders.oAdmin','=',$idAdmin)
                    ->Where('orders.oStatus','=','รอชำระเงิน')->count();
        $count5 =  DB::table('orders')->where('orders.oAdmin','=',$idAdmin)
                    ->Where('orders.oStatus','=','กำลังตรวจสอบการชำระเงิน')->count();
        $count6 =  DB::table('orders')->where('orders.oAdmin','=',$idAdmin)
                    ->Where('orders.oStatus','=','รอยืนยันการต่อรองราคา')->count();
        $count2 = $count2 + $count6;
        $count = $count4 + $count5;

        //check exp
        $oStatus=DB::table('status')->where('status', '=', "หมดอายุ")->value('status');
        $today = Carbon::today();          
        $order=DB::table('orders')->get();
        foreach($order as $o){
            $exp =  DB::table('orders')->where('oID', '=', $o->oID)->value('oExp');                        
            if($today >= $exp){
                DB::table('orders')->where('oID','=',$o->oID)->update([
                    'oStatus'=>$oStatus
                ]);
            }
        } 

        //check tier customer
        $countOrder = DB::select("SELECT cID,sum(oAmountVat) as sum,count(oID) as countOrder FROM orders where oStatus = 'คำสั่งซื้อสำเร็จแล้ว' group by (cID) ");
        foreach($countOrder as $co){
            if($co->countOrder >= 15 and $co->sum > 500000){
                DB::table('customers')->where('cID','=', $co->cID)->update([
                    'tierID' => 1]);
            }elseif($co->countOrder >= 15){
                DB::table('customers')->where('cID','=', $co->cID)->update([
                    'tierID' => 2]);
            }elseif($co->countOrder >= 2){
                DB::table('customers')->where('cID','=', $co->cID)->update([
                    'tierID' => 4]);
            }
        }
        
        return view('admin/admin',['items_in_cart'=>$items_in_cart, 'count1'=>$count1,
                    'allOrders'=>$allOrders,'products'=>$products, 'orders'=>$orders, 'count2'=>$count2,
                    'count3'=>$count3, 'count'=>$count, 'evidences'=>$evidences]);
    }

    public function customerList(request $request)
    { 
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }

        $orders = DB::select("SELECT cID,sum(oAmountVat) as sum, count(oID) as countOrder, cFname, cLname, cAddress,cCompany, cPhone, tierName FROM orders join customers using(cID) join tier using (tierID) where oStatus = 'คำสั่งซื้อสำเร็จแล้ว' group by (cID) ");
        $customers = DB::table('customers')->join('tier', 'tier.tierID', '=', 'customers.tierID')->reorder('customers.tierID', 'ASC')->get();

        return view('admin/customerList',['items_in_cart'=>$items_in_cart, 'orders'=>$orders, 'customers'=>$customers]);
    }

    public function quotation(request $request)
    { 
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }
        $oID=$request->input('oID');
        //$customer=DB::table('orders')->join('customers','orders.cID','=','customers.cID')->where('oID','=',$oID)->get();
        $order=DB::table('orders')->where('oID','=',$oID)->get();
        $oShipAddress=DB::table('orders')->where('oID','=',$oID)->value('oShipAddress');

        $details=DB::table('details')
        ->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')
        ->where('oID', '=', $oID)
        ->where('dInStock', '=', 1)->get();

        $count=DB::table('details')
        ->where('oID', '=', $oID)
        ->where('dInStock', '=', 1)
        ->count();

        $bargains=DB::table('bargains')
        ->where('oID', '=', $oID)
        ->orderBy('time_stamp', 'DESC')
        ->limit($count)
        ->get();

        if($oShipAddress=="รับเอง"){
            $haveCost=0;
        }else{
            $haveCost=1;
        }

        return view('admin/quotation',['items_in_cart'=>$items_in_cart,'details'=>$details,'bargains'=>$bargains,'order'=>$order,'haveCost'=>$haveCost]);
          
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
        $amountVat = 0;
        $saler = Auth::id();
        $status = DB::table('orders')->where('oID','=',$oID)->value('oStatus');
        $exp = Carbon::parse($today)->addWeek();
        
        if(Auth::user()->status=='admin' && $status == 'อยู่ในระหว่างการขอใบเสนอราคา'){
            $oStatus=DB::table('status')->where('status', '=', "รอยืนยันใบเสนอราคา")->value('status');

            for($i = 0; $i < count($pID); $i++){
                if($inStock[$i] == 1){
                    DB::table('details')->where('pID','=', $pID[$i])->where('oID','=',$oID)->update([
                        'dPrice' => $price[$i], 
                        'dInStock'=>$inStock[$i]]);
                    $amountVat += $qty[$i]*$price[$i];
                }else{
                    DB::table('details')->where('pID','=', $pID[$i])->where('oID','=',$oID)->update([
                        'dPrice' => 0, 
                        'dInStock'=>$inStock[$i]]);
                }
                
            }
            $amountVat = round($amountVat, 2); 
            $vat = round(($amountVat*7)/107, 2); 
            $amount = round($amountVat-$vat, 2);  
            
            DB::table('orders')->where('oID','=',$oID)->update([
                'oShipCost'=>$cost,
                'oAmountVat'=>$amountVat,
                'oStatus'=>$oStatus,
                'oAmount'=>$amount,
                'oVat'=>$vat,
                'oNote'=>$note,
                'oDate'=>$today,
                'oDateQ'=>$today,                
                'oExp' =>$exp,
                'oAdmin'=>$saler
            ]);
            return redirect('/admin?=รอยืนยัน')->with('success','Please fill all required field.');
        }

        elseif(Auth::user()->status=='ลูกค้า' && $status == 'รอยืนยันใบเสนอราคา'){
            $oStatus=DB::table('status')->where('status', '=', "อยู่ในระหว่างการต่อรองราคา")->value('status');

            for($i = 0; $i < count($pID); $i++){
                $dID = DB::table('details')->where('pID','=', $pID[$i])->where('oID','=',$oID)->value('dID');
                $bID=$this->getTotalBargains();

                DB::table('bargains')->insert([
                    'bID' => $bID,
                    'dID' => $dID,
                    'oID' => $oID,
                    'bPrice' => $price[$i]
                ]);
                DB::table('orders')->where('oID',$oID)->update([
                    'oStatus'=>$oStatus,
                    'oDateQ'=>$today
                ]);
            }
            return redirect('/customer?ต่อรองราคา=')->with('success','Please fill all required field.');

        }
        elseif(Auth::user()->status=='admin' && $status == 'อยู่ในระหว่างการต่อรองราคา'){
            $oStatus=DB::table('status')->where('status', '=', "รอยืนยันการต่อรองราคา")->value('status');

            for($i = 0; $i < count($pID); $i++){
                $dID = DB::table('details')->where('pID', $pID[$i])->where('oID','=',$oID)->value('dID');
                $bID=$this->getTotalBargains();

                DB::table('bargains')->insert([
                    'bID' => $bID,
                    'dID' => $dID,
                    'oID' => $oID,
                    'bPrice' => $price[$i]
                ]);
                DB::table('orders')->where('oID',$oID)->update([
                    'oStatus'=>$oStatus,
                    'oDateQ'=>$today
                ]);
            }
            return redirect('/admin?รอยืนยัน=');
        }
                  
    }

    public function ViewPdf(request $request){

        //เพิ่มตารางเก็บค่าชื่อ Admin ที่สร้างใบเสนอราคานั้นๆ 
        $today = Carbon::now();
        $day = $today->toDateString();
        $oID=$request->input('oID');
        $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',1)->get();
        $outOfStock = DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
        ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',0)->get();
        $orders =  DB::table('orders')->where('oID', '=', $oID)->get();
        $saler =  DB::table('orders')->join('users','users.id','=','orders.oAdmin')->where('oID', '=', $oID)->value('users.name');

        $count=DB::table('details')
        ->where('oID', '=', $oID)
        ->where('dInStock', '=', 1)
        ->count();

        $bargains=DB::table('bargains')
        ->where('oID', '=', $oID)
        ->orderBy('time_stamp', 'DESC')
        ->limit($count)
        ->get();

        $cost =  DB::table('orders')->where('oID', '=', $oID)->value('oShipCost');

        $amountVat = 0;

        foreach($bargains as $bargain){
            $dQuantity = DB::table('details')->where('dID', '=', $bargain->dID)->value('dQuantity');
            $total = $bargain->bPrice * $dQuantity;
            $amountVat += $total;
        }

        $amountVat += $cost;
        $amountVat = round($amountVat, 2); 
        $vat = round(($amountVat*7)/107, 2); 
        $amount = round($amountVat-$vat, 2);
        

        $pdf = PDF::loadView('admin/QuotationPdf',['details'=>$details, 'orders'=>$orders, 'outOfStock'=>$outOfStock,'saler'=>$saler,'bargains'=>$bargains,'amountVat'=>$amountVat,
                'vat'=>$vat,'amount'=>$amount, 'day' =>$day]);

        return $pdf->stream();
    }

    // public function ViewPdf(request $request){

    //     //เพิ่มตารางเก็บค่าชื่อ Admin ที่สร้างใบเสนอราคานั้นๆ 
    //     $oID=$request->input('oID');
    //     $details=DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
    //     ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',1)->get();
    //     $outOfStock = DB::table('details')->join('products', 'details.pID', '=', 'products.pID')
    //     ->join('type', 'type.tID', '=', 'products.tID')->where('oID', '=', $oID)->where('dInStock','=',0)->get();
    //     $orders =  DB::table('orders')->where('oID', '=', $oID)->get();
    //     $saler =  DB::table('orders')->join('users','users.id','=','orders.oAdmin')->where('oID', '=', $oID)->value('users.name');
    //     $pdf = PDF::loadView('admin/QuotationPdf',['details'=>$details, 'orders'=>$orders, 'outOfStock'=>$outOfStock,'saler'=>$saler]);

    //     return $pdf->stream();
    // }

    public function cancel(request $request){

        $oID = $request->input('oID');
        $oStatus=DB::table('status')->where('status', '=', "รอยืนยันการต่อรองราคา")->value('status');
        DB::table('orders')->where('oID','=',$oID)->update([
            'oStatus'=>$oStatus
        ]);
        $today = Carbon::today();   

        $details=DB::table('details')->where('oID', '=', $oID)->get();

        foreach($details as $detail){
            $bID=$this->getTotalBargains();

            DB::table('bargains')->insert([
                'bID' => $bID,
                'dID' => $detail->dID,
                'oID' => $oID,
                'bPrice' => $detail->dPrice
            ]);
            DB::table('orders')->where('oID',$oID)->update([
                'oStatus'=>$oStatus,
                'oDateQ'=>$today
            ]);
        }
        
        return redirect()->back();
    }

    public function confirm(request $request){

        $oID = $request->input('oID');
        $oStatus=DB::table('status')->where('status', '=', "รอชำระเงิน")->value('status');

        $count=DB::table('details')
        ->where('oID', '=', $oID)
        ->where('dInStock', '=', 1)
        ->count();

        $details=DB::table('details')->where('dInStock','=',1)->get();
        $bargains=DB::table('bargains')
        ->where('oID', '=', $oID)
        ->orderBy('time_stamp', 'DESC')
        ->limit($count)
        ->get();

        $cost =  DB::table('orders')->where('oID', '=', $oID)->value('oShipCost');
        $amountVat = 0;

        foreach($details as $detail){
            foreach($bargains as $bargain){
                if($bargain->dID == $detail->dID){
                    DB::table('details')->where('dID',$detail->dID)->update([
                        'dPrice'=>$bargain->bPrice
                    ]);
                    $total = $bargain->bPrice * $detail->dQuantity;
                    $amountVat += $total;                    
                }
            }
        }

        $amountVat += $cost;
        $amountVat = round($amountVat, 2); 
        $vat = round(($amountVat*7)/107, 2); 
        $amount = round($amountVat-$vat, 2);
        
        DB::table('orders')->where('oID','=',$oID)->update([
            'oStatus'=>$oStatus,
            'oAmountVat'=>$amountVat,
            'oVat'=>$vat,
            'oAmount'=>$amount,
        ]);


        return redirect()->back();
    }

    public function paymentCancel(request $request){
        $oID = $request->input('oID');
        $oStatus=DB::table('status')->where('status', '=', "รอชำระเงิน")->value('status');
        DB::table('orders')->where('oID','=',$oID)->update([
            'oStatus'=>$oStatus
        ]);

        return redirect()->back();
    }

    public function paymentConfirm(request $request){
        $oID = $request->input('oID');
        $oStatus=DB::table('status')->where('status', '=', "คำสั่งซื้อสำเร็จแล้ว")->value('status');
        $today = Carbon::today();  
        DB::table('orders')->where('oID','=',$oID)->update([
            'oStatus'=>$oStatus,
            'oDateQ'=>$today
        ]);

        return redirect()->back();
    }
    
}
