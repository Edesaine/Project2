<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $books = Book::take(9)->get();
        $sach = Book::orderBy("price","desc")->first();
        return view('Customer.Layout.index', compact('books','customer','sach'));
    }
    public function search(Request $request)
    {
        $search="";
        if($request->search){
            $search=$request->search;
        }
        $customer = Auth::guard('customer')->user();
        $books = Book::where('books.name', 'like', '%' . $search . '%')
            ->get();
        return view('Customer.Layout.search', compact('books','customer','search'));
    }
}
