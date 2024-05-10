<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        return view('admin.layouts.dashboard',compact('LoginName','LoginEmail'));
    }
}
