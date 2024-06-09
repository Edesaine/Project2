<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Method;
use App\Models\Publisher;
use App\Models\AuthorBook;
use App\Models\CategoryBook;
use App\Models\Shipping;
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
        $customer = Auth::guard('customer')->user();
        $book = Book::with('authors', 'categories')->findOrFail($id);
        $fileName = '';
        $pub = Publisher::findOrFail($book->publisher_id);

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

        $relaBook = Book::orderBy('quantity', 'asc')->take(6)->get();
        return view('Customer.product.detail', ['relaBook' => $relaBook],
            compact('customer','book','pub','fileName'));
    }

    public function cart()
    {
        $customer = Auth::guard('customer')->user();
        return view('Customer.carts.cart', compact('customer'));
    }

    public function addToCart(int $id)
    {
        $book = Book::where('id', $id)
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
            $book = Book::where('id', $id)
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
        $shipping_methods = Shipping::all();
        $payment_methods = Method::all();
        $customer_id = Auth::guard('customer')->id();
        $customer = Customer::find($customer_id);
        return view('Customer.carts.checkout', [
            'customer' => $customer,
            'payment_methods' => $payment_methods,
            'shipping_methods' => $shipping_methods
        ]);
    }


    //Admin
    public function index(Request $request)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $search='%%';
        if($request->search){
            $search='%'.$request->search.'%';
        }
        $books = DB::table("books")
            ->join('publishers','books.publisher_id','=','publishers.id')
            ->select("books.*","publishers.name AS publisher")
            ->where('books.name','like',$search)
            ->paginate(4);

        return view('admin.book_manager.index',compact('books','LoginName','LoginEmail'));
    }

    public function create()
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $publishers = Publisher::get();
        return view('admin.book_manager.create',compact('publishers','LoginName','LoginEmail'));
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
        $book=Book::where('name',$request->name)
            ->first();
        return redirect()->route('book.addinformation', ['id' => $book->id]);

    }

    public function addinfomation(int $id){
        $book=Book::FindorFail($id);
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $authors = Author::get();
        $categories= Category::get();
        return view('Admin.book_manager.addinfomation',compact('categories','authors','book','LoginName','LoginEmail'));

    }
    public function addinfomationprocess(Request $request){
        $bookId = $request->id;
        $authorIds = [];
        $categoryIds = [];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'author_id') === 0 && !is_null($value)) {
                $authorIds[] = $value;
            }
            if (strpos($key, 'category_id') === 0 && !is_null($value)) {
                $categoryIds[] = $value;
            }
        }

        // Insert thông tin tác giả vào bảng book_authors
        foreach ($authorIds as $authorId) {
            AuthorBook::create([
                'book_id' => $bookId,
                'author_id' => $authorId
            ]);
        }

        // Insert thông tin thể loại vào bảng book_categories
        foreach ($categoryIds as $categoryId) {
            CategoryBook::create([
                'book_id' => $bookId,
                'category_id' => $categoryId
            ]);
        }
        return redirect('book/index');
    }

    public function edit(int $id)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $book = Book::findOrFail($id);
        $pub=Publisher::findOrFail($book->publisher_id);
        $publishers= Publisher::get();
        return view('admin.book_manager.edit', compact('book','pub','publishers','LoginName','LoginEmail'));
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

            $path = 'uploads/books/';
            $file->move($path, $filename);

            if(File::exists($book->image)){
                File::delete($book->image);
            }
            $image = $path.$filename;
        }else{
            $image = $book->image;
        }

        $book->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $image,
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

    public function ChangeStatus(int $id)
    {
        $book = Book::findOrFail($id);
        if($book->status==0){
            $book->update([
                'status'=>1
            ]);
        } else{
            $book->update([
                'status'=>0
            ]);
        }
        return redirect()->back()->with('status','Books Edited !');
    }
    public function detail(int $id)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');

        $book = Book::findOrFail($id);
        $info=DB::table('books')
            ->join('publishers','books.publisher_id','=','publishers.id')
            ->join('authorbooks','books.publisher_id','=','publishers.id')
            ->where('books.id','=',$id)
            ->select('books.*','publishers.name as publisher')
            ->get();

        $publishers= Publisher::get();
        return view('admin.book_manager.detail', compact('book','info','publishers','LoginName','LoginEmail'));
    }
}
