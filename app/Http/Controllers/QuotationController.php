<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use SebastianBergmann\Environment\Console;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function Eid() {
        $evidences = DB::select('SELECT * FROM evidences');
        $num = count($evidences);
        ++$num; // add 1;
        $len = strlen($num);
        for($i=$len; $i< 4; ++$i) {
            $num = '0'.$num;
        }
        $eID = 'EV'.$num;
        return $eID;
    }    

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

        $evidences = DB::table('evidences')->groupby('oID')->get();

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
        $count6 =  DB::table('orders')->where('orders.cID','=',$idCustomer)
                    ->Where('orders.oStatus','=','รอยืนยันการต่อรองราคา')->count();
        $count2 = $count2 + $count6;
        $count = $count4 + $count5;

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

        //ยอดสะสม
        $sum = DB::select("SELECT sum(oAmountVat) as sum FROM orders where cID = ? and oStatus = 'คำสั่งซื้อสำเร็จแล้ว'",[$idCustomer]);
        $percent = (int)(($sum[0]->sum*100)/500000);
        if($percent>100){
            $percent = 100;
        }
        $sum = (number_format($sum[0]->sum));
        
               
        return view('customer/QuotationConfirm',['items_in_cart'=>$items_in_cart, 'count1'=>$count1,
                    'details'=>$details, 'products'=>$products, 'orders'=>$orders, 'count2'=>$count2,
                    'count3'=>$count3, 'count'=>$count, 'evidences'=>$evidences, 'sum'=>$sum, 'percent'=>$percent]);
    }

    public function QuotationConfirm(request $request){

        $oID = $request->input('oID');
        DB::table('orders')->where('oID',$oID)->update(['oStatus'=>'รอชำระเงิน']);

        return redirect()->back();
    }

    public function QuotationCancel(request $request){
        
        $oID = $request->input('oID');
        DB::table('orders')->where('oID',$oID)->update(['oStatus'=>'ยกเลิกคำสั่งซื้อ']);
        
        return redirect()->back();
    }

    public function ViewEvi(request $request)
    {
        if(session()->has('cart')){
            $items_in_cart = count(session()->get('cart'));
        }else {
            $items_in_cart = 0 ;
        }

        $oID=$request->input('oID');
        $orders= DB::table('orders')->where('oID',$oID)->get();

        return view('customer/evidence',['items_in_cart'=>$items_in_cart, 'oID'=>$oID, 'orders'=>$orders]);
    }

    public function UploadFile(request $request){

        // $evidence=$request->input('evidence');
        $oID=$request->input('oID');
        $cID = Auth::id();
        $eID = $this->Eid();
        if($file = $request->file('evidence') ){
            $file_name = $file-> getClientOriginalName();
            $file -> move('images/evidence',$file_name);
        
            DB::table('orders')->where('oID',$oID)->update(['oStatus'=>'กำลังตรวจสอบการชำระเงิน']);
            DB::table('evidences')->insert([
                'eID' => $eID,
                'oID' => $oID,
                'cID' => $cID,
                'eImg' => $file_name
            ]);
        }

        return redirect('/customer?รอชำระเงิน=');

    }
}
