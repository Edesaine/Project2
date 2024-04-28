<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function adminlogin()
    {
        return view('admin.account.signin');
    }
    public function loginprocess(Request $request)
    {
        $request->validate([
                'email'=>'required|string',
                'password'=>'required|string'
            ]
        );
        $admins=Admin::where('email',$request->email)->first();
        if($admins){
            if($request->password==$admins->password){
                $request->session()->put('loginId',$admins->id);
                $request->session()->put('loginname',$admins->name);
                $request->session()->put('loginemail',$admins->email);
                return redirect('dashboard');
            }else{
                return back()->with('fail','Wrong password !');
            }
        }else{
            return back()->with('fail','This email is not registered');
        }
    }
    public function logout()
    {
        if(Session::has('loginId')){
            Session::forget('loginemail');
            Session::forget('loginId');
            Session::forget('loginname');
            return redirect('adminlogin');
        }else{
            return redirect('dashboard');
        }

    }
}
