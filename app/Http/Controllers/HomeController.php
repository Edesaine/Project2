<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Requests;


class HomeController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('Customer.Layout.index', compact('books'));
    }
}
