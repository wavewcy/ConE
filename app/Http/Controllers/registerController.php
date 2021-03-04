<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{

    public function EmpReg(request $request){
        $Fname = $request->Input('Fname');
        $Lname = $request->Input('Lname');
        $name = $Fname." ".$Lname;
        $email = $request->Input('email');
        $pass = $request->Input('pass');
        $status = $request->Input('status');

        $idMax = User::max('id');
        $id = $idMax + 1;
        
        DB::table('users')->insert(
            ['id' => $id,
            'name' =>$name,
            'email' => $email,
            'status' => $status,
            'password' => Hash::make($pass),]);

        return redirect()->back();
    }

    public function CustomerReg(request $request){
        $Fname = $request->Input('Fname');
        $Lname = $request->Input('Lname');
        $name = $Fname." ".$Lname;
        $email = $request->Input('email');
        $pass = $request->Input('pass');
        
        $company = $request->Input('company');
        $address = $request->Input('address');
        $phone = $request->Input('phone');

        $idMax = User::max('id');
        $id = $idMax + 1;
        
        DB::table('users')->insert(
            ['id' => $id,
            'name' =>$name,
            'email' => $email,
            'status' => "ลูกค้า",
            'password' => Hash::make($pass),]);
        
        if($company == null){
            DB::table('customers')->insert(
                ['cid' => $id,
                'cFname' =>$Fname,
                'cLname' =>$Lname,
                'cAddress' => $address,
                'cPhone' => $phone,]);
        }else{
            DB::table('customers')->insert(
                ['cid' => $id,
                'cFname' =>$Fname,
                'cLname' =>$Lname,
                'cCompany' =>$company,
                'cAddress' => $address,
                'cPhone' => $phone,]);
        }
        
        return redirect('/login')->with('success','Please fill all required field.');
    }
    
}
