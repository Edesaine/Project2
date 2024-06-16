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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use function Sodium\add;


class OrderController extends Controller
{
    public function checkoutProcess(OrderStoreRequest $request)
    {
        $amount = [];
        $cart = Session::get('cart');

        //Kiem tra gio hang co bi null hay ko
        if (is_null($cart) || empty($cart)) {
            return Redirect::route('Customer.carts.cart')->with('error', 'Your cart is empty!');
        }
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
        $paymentID = $request->input('payment_method');
        //1: Fast delivery, 2: Normal Delivery
        $methodId = 1;
/*        $methodId = $request->input('shipping_method');*/
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
        $array = Arr::add($array, 'payment_id', $paymentID);
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

    public function cancelOrder(Order $order)
    {
        if (/*$order->status != 1 && */
            $order->status != 4) {
            $array = [];
            $array = Arr::add($array, 'status', 4);

            $order->update($array);

            // Trả về với thông báo thành công
            return  to_route('Customer.carts.orderHistory', ['order' => $order->id])->with('success', 'Cancel order successfully!');
        }

        // Nếu trạng thái đơn hàng là 4, trả về với thông báo lỗi
        return to_route('Customer.carts.orderDetails', ['order' => $order->id])
            ->with('error', 'Order cannot be cancelled as it is already in the cancelled state.');
    }

    //ADMIN
    public function index(Request $request)
    {
        $LoginName = Session::get('loginname');
        $LoginEmail = Session::get('loginemail');
        $search = '%%';
        if ($request->search) {
            $search = '%' . $request->search . '%';
        }
        $orders = DB::table('orders')
            ->join('payment_method', 'orders.method_id', '=', 'payment_method.id')
            ->join('customer', 'orders.customer_id', '=', 'customer.id')
            ->join('admins', 'orders.admin_id', '=', 'admins.id')
            ->select('orders.*', 'payment_method.name as paymentname', 'customer.name as name', 'admins.name as admin')
            ->where('orders.receiver_name', 'like', $search)
            ->orWhere('orders.receiver_address', 'like', $search)
            ->orWhere('orders.receiver_phone', 'like', $search)
            ->orWhere('customer.name', 'like', $search)
            ->OrderBy('orders.date_buy', 'DESC')
            ->OrderBy('orders.status', 'ASC')
            ->paginate(5);
        return view('admin.order_manager.index', compact('orders', 'LoginName', 'LoginEmail'));
    }

    public function details(int $id, Request $request)
    {
        $LoginName = Session::get('loginname');
        $LoginEmail = Session::get('loginemail');
        $search = '%%';
        if ($request->search) {
            $search = '%' . $request->search . '%';
        }

        $orders = DB::table('order_details')
            ->join('books', 'order_details.book_id', '=', 'books.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('order_details.*', 'books.name as name', 'books.image as image', 'orders.status as status')
            ->where('books.name', 'like', $search)
            ->where('order_details.order_id', '=', $id)
            ->paginate(3);
        $status = Order::findOrFail($id);
        return view('admin.order_manager.details', compact('orders', 'LoginName', 'LoginEmail', 'id', 'status'));
    }

    public function ChangeStatus(int $id, Request $request)
    {
        if ($request->id) {
            $id = $request->order_id;
        }        $order = Order::findOrFail($id);

        $order = Order::findOrFail($id);

        if ($order->status == 2 || $order->status == 3) {
            // Lấy chi tiết đơn hàng
            $orderDetails = $order->orderDetails;

            // Cập nhật số lượng sách trong bảng books
            foreach ($orderDetails as $orderDetail) {
                $book = Book::findOrFail($orderDetail->book_id);
                $book->quantity -= $orderDetail->sold_quantity;
                $book->save();
            }
        }

        $order->update([
            'admin_id' => Session::get('loginId'),
            'status' => $request->status
        ]);



        return redirect()->back()->with('status','Orders Edited !');
    }
    public function ApproveOrder(int $id)
    {
        $orders = Order::findOrFail($id);
        $orders->update([
            'admin_id' => Session::get('loginId'),
            'status' => 1
        ]);
        return redirect()->back();
    }

    public function approve(Request $request)
    {
        $LoginName = Session::get('loginname');
        $LoginEmail = Session::get('loginemail');
        $search = '%%';
        if ($request->search) {
            $search = '%' . $request->search . '%';
        }
        $orders = DB::table('orders')
            ->join('payment_method', 'orders.method_id', '=', 'payment_method.id')
            ->join('customer', 'orders.customer_id', '=', 'customer.id')
            ->join('admins', 'orders.admin_id', '=', 'admins.id')
            ->select('orders.*', 'payment_method.name as paymentname', 'customer.name as name', 'admins.name as admin')
            ->where('orders.status', '=', 0)
            ->Where('customer.name', 'like', $search)
            ->OrderBy('orders.date_buy', 'DESC')
            ->paginate(5);
        return view('admin.order_manager.approve_orders', compact('orders', 'LoginName', 'LoginEmail'));
    }
}
