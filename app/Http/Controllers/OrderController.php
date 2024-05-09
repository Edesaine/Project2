<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Book;
use App\Requests\OrderStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use function Sodium\add;

class OrderController extends Controller
{
    public function checkoutProcess(OrderStoreRequest $request)
    {
        $amount = []; // Khởi tạo biến $amount

        foreach (Session::get('cart') as $book_id => $book) {
            // Tính và gán giá trị vào biến $amount
            $amount[$book_id] = $book['price'] * $book['quantity'];
        }
        //date mua hang
        $dateBuy = date("Y-m-d H:i:s");
        $totalAmount = array_sum($amount);
        //lay status (status mac dinh la 0 tuong ung trang thai xac nhan don hang)
        $status = 0;
        //1: pay on delivery, 2: pay on vnpay
        $methodId = 1;
        //customer id
        $customerId = Auth::guard('customer')->id();

////        if ($request->validated()) {
        $array = [];
        $array = Arr::add($array, 'date_buy', $dateBuy);
        $array = Arr::add($array, 'status', $status);
        $array = Arr::add($array, 'receiver_name', $request->receiver_name);
        $array = Arr::add($array, 'receiver_phone', $request->receiver_phone);
        $array = Arr::add($array, 'receiver_address', $request->receiver_address);
        $array = Arr::add($array, 'admin_id', 1);
        $array = Arr::add($array, 'customer_id', $customerId);
        $array = Arr::add($array, 'amount', $totalAmount);
        $array = Arr::add($array, 'method_id', $methodId);
        Order::create($array);

        $maxOrderId = Order::where('customer_id', $customerId)->max('id');
        if (!$maxOrderId) {
            $maxOrderId = 1;
        }

        //lay du lieu de insert vao bang order_details
        foreach (Session::get('cart') as $book_id => $book) {
            $orderDetails = [];
            $orderDetails = Arr::add($orderDetails, 'order_id', $maxOrderId);
            $orderDetails = Arr::add($orderDetails, 'book_id', $book_id);
            $orderDetails = Arr::add($orderDetails, 'sold_price', $book['price']);
            $orderDetails = Arr::add($orderDetails, 'sold_quantity', $book['quantity']);

            $productQuantity = Book::find($book_id);
            $productQuantity->quantity -= $book['quantity'];
            $productQuantity->save();
            OrderDetail::create($orderDetails);
        }

        Session::forget('cart');
        return Redirect::route('Customer.carts.orderHistory')->with('success', 'Order created successfully!');
//        } else {
//            dd("loi");
////            return Redirect::route('checkout')->with('error', 'Create order failed!');
//        }
    }

    public function cancelOrder(Order $orders)
    {
        $array = [];
        $array = Arr::add($array, 'status', 4);
        $orders->update($array);
        return to_route('Customer.carts.orderHistory')->with('success', 'Cancel order successfully!');
    }

    //ADMIN
    public function index()
    {
        $orders = Order::with('admin')->paginate(6);
        return view("Admin.order_manager.index", [
            "orders" => $orders,
        ]);
    }

    public function showDetail(Order $orders)
    {
        $orderId = $orders->id;
        $orderDetails = DB::table('orders_details')
            ->where('order_id', '=', $orderId)
            ->join('books', 'orders_details.book_id', '=', 'books.id')
            ->get();

        $orderAmount = 0;
        $orderItems = 0;
        foreach ($orderDetails as $detail) {
            $orderItems += $detail->sold_quantity;
            $orderAmount += $detail->sold_price * $detail->sold_quantity;
        }
        $orderTotal = $orderAmount + 10;
        $admins = Admin::where('id', '=', $orders->admin_id)->first();
//        $product = Product::all();
//        $customer = Customer::all();
//        $admin = Admin::all();
        return view('Admin.order_manager.order-detail', [
            'orders' => $orders,
            'admins' => $admins,
            'order_details' => $orderDetails,
            'order_item' => $orderItems,
            'order_amount' => $orderAmount,
            'order_total' => $orderTotal,
//            'product' => $product,
//            'customer' => $customer,
//            'admin' => $admin
        ]);
    }

}
