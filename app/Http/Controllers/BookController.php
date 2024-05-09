<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function bookDetail(int $id, Request $request)
    {
        $book = Book::findOrFail($id); // Khởi tạo biến $book ở đầu hàm
        $fileName = '';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/uploads/books/');
            $fileName = basename($imagePath);
            /* $book=DB::table('books')
                 ->join('publishers','books.publisher_id','=','publishers.id')
                 ->select('books.*','publishers.name as publisher')
                 ->where('books.id','=',$id)
                 ->get(); */
            $book->image = $fileName;
            $book->save();
        }

        $relaBook = Book::orderBy('quantity','asc')->take(4)->get();
        return view('Customer.product.detail', compact('book','relaBook','fileName'));
    }

    public function cart()
    {
        return view('Customer.carts.cart');
    }

    public function addToCart(int $id)
    {
        $book = Book::with('author')
            ->with('category')
/*            ->with('name')*/
            ->where('id', $id)
            ->first();
//        neu da co cart
        if (Session::exists('cart')) {
//            lay cart hien tai
            $cart = Session::get('cart');
//            neu san pham da co trong cart => +1 so luong
            if (isset($cart[$book->id])) {
                $cart[$book->id]['quantity']++;
            } else {
//                them sp vao cart
                $cart = Arr::add($cart, $book->id, [
                    'image' => $book->image,
                    'name' => $book->name,
                    'price' => $book->price,
                    'quantity' => 1,
                ]);
            }
        } else {
//            tao cart moi
            $cart = array();
            $cart = Arr::add($cart, $book->id, [
                'image' => $book->image,
                'name' => $book->name,
                'price' => $book->price,
                'quantity' => 1,
            ]);
        }
//        nem cart len session
        Session::put(['cart' => $cart]);
        return Redirect::route('Customer.carts.cart');
    }

    public function addToCartAjax(int $id)
    {
        if (!Auth::guard('customer')->check()) {
            return Redirect::route('Customer.account.login');
        } else {
            $book = Book::with('author')
                ->with('category')
                ->where('id', $id)
                ->first();

//        neu da co cart
            if (Session::exists('cart')) {
//            lay cart hien tai
                $cart = Session::get('cart');
//            neu san pham da co trong cart => +1 so luong
                if (isset($cart[$book->id])) {
                    $cart[$book->id]['quantity']++;
                } else {
//                them sp vao cart
                    $cart = Arr::add($cart, $book->id, [
                        'image' => $book->image,
                        'name' => $book->name,
                        'price' => $book->price,
                        'quantity' => 1,
                    ]);
                }
            } else {
//            tao cart moi
                $cart = array();
                $cart = Arr::add($cart, $book->id, [
                    'image' => $book->image,
                    'name' => $book->name,
                    'price' => $book->price,
                    'quantity' => 1,
                ]);
            }
//        nem cart len session
            Session::put(['cart' => $cart]);
            return Redirect::back()->with('success', 'Add item to cart successfully!');
        }
    }

    public function updateCartQuantity(int $id, Request $request)
    {
        //        lay cart hien tai
        $cart = Session::get('cart');
//        cap nhat so luong
        $cart[$id]['quantity'] = $request->buy_quantity;
        //        cap nhat cart moi
        Session::put(['cart' => $cart]);
        return Redirect::back();
    }

    public function deleteFromCart(Request $request)
    {
//        lay cart hien tai
        $cart = Session::get('cart');
//        xoa id cua product can xoa
        Arr::pull($cart, $request->id);
//        cap nhat cart moi
        Session::put(['cart' => $cart]);

        return Redirect::back();
    }

    public function deleteAllFromCart()
    {
//       xoa cart
        Session::forget('cart');

        return Redirect::back();
    }

    public function checkout()
    {
        $customer_id = Auth::guard('customer')->id();
        $customer = Customer::find($customer_id);
        return view('Customer.carts.checkout', [
            'customer' => $customer
        ]);
    }

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

            $path = 'storage/uploads/books/';
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

            $path = 'storage/uploads/books/';
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
