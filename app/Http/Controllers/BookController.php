<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $search='%%';
        if($request->search){
            $search='%'.$request->search.'%';
        }
        $books = DB::table("books")
            ->join('publishers','books.id','=','publishers.id')
            ->select("books.*","publishers.name AS publisher")
            ->where('books.name','like',$search)
            ->get();

        return view('admin.book_manager.index',compact('books'));
    }
    public function create()
    {

        $publishers = Publisher::get();
        return view('admin.book_manager.create',compact('publishers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|integer',
            'description' => 'required|string',
            'publisher_id' => 'required|integer',
            'NumberOfPages' => 'required|integer',
            'NumberOfAuthors' => 'required|integer',
            'NumberOfCategories' => 'required|integer'
        ]);
        if($request->has('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/books/';
            $file->move($path, $filename);
        }
        Book::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $path.$filename,
            'description' => $request->description,
            'publisher_id' => $request->publisher_id,
            'NumberOfAuthors' => $request->NumberOfAuthors,
            'NumberOfCategories' => $request->NumberOfCategories,
            'NumberOfPages' => $request->NumberOfPages
        ]);
        return redirect()->back()->with('status','Books Created !');
    }
    public function edit(int $id)
    {

        $book = Book::findOrFail($id);
        $pub=DB::table('books')
        ->join('publishers','books.publisher_id','=','publishers.id')
        ->where('books.id','=',$id)
        ->select('books.*','publishers.name as publisher')
        ->get();
        $publishers= Publisher::get();
        return view('admin.book_manager.edit', compact('book','pub','publishers'));
    }
    public function update(Request $request, int $id){
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'quantity' => 'required|integer',
            'description' => 'required|string',
            'publisher_id' => 'required|integer',
            'NumberOfPages' => 'required|integer',
            'NumberOfAuthors' => 'required|integer',
            'NumberOfCategories' => 'required|integer'
        ]);
        $book = Book::findOrFail($id);
        if($request->has('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/product/';
            $file->move($path, $filename);

            if(File::exists($book->image)){
                File::delete($book->image);
            }
        }

        $book->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $path.$filename,
            'description' => $request->description,
            'publisher_id' => $request->publisher_id,
            'NumberOfAuthors' => $request->NumberOfAuthors,
            'NumberOfCategories' => $request->NumberOfCategories,
            'NumberOfPages' => $request->NumberOfPages
        ]);
        return redirect()->back()->with('status','Books Edited !');
    }
    public function delete(int $id)
    {
        $book = Book::findOrFail($id);
        if(File::exists($book->image)){
            File::delete($book->image);
        }
        $book->delete();

        return redirect()->back()->with('status','Book Deleted !');
    }

}
