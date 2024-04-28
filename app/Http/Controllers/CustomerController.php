<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Requests\CustomerStoreRequest;
use App\Requests\CustomerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class CustomerController extends Controller
{
    public function register()
    {
        return view('Customer.account.register');
    }

    public function registerProcess(CustomerStoreRequest $request)
    {
        if ($request->validated()) {
            $array = [];
            $array = Arr::add($array, 'name', $request->name);
            $array = Arr::add($array, 'email', $request->email);
            $array = Arr::add($array, 'password', Hash::make($request->password));
            $array = Arr::add($array, 'phone', $request->phone);
            $array = Arr::add($array, 'gender', $request->gender);
            $array = Arr::add($array, 'address', $request->address);
            $array = Arr::add($array, 'account_status', 1);
            //Lấy dữ liệu từ form và lưu lên db
            Customer::create($array);

            return Redirect::route('Customer.account.login');
        } else {
            //cho quay về trang login
            return Redirect::back('profile');
        }
    }

    public function login()
    {
        return view('Customer.account.login');
    }

    public function loginProcess(Request $request)
    {
        $account = $request->only(['email', 'password']);
        $check = Auth::guard('customer')->attempt($account);

        if ($check) {
            //Lấy thông tin của customer đang login
            $customer = Auth::guard('customer')->user();
            //Cho login
            Auth::guard('customer')->login($customer);
            //Ném thông tin customer đăng nhập lên session
            session(['customer' => $customer]);
            return Redirect::route('profile');
        } else {
            //cho quay về trang login
            return Redirect::back();
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        session()->forget('customer');
        return view('Customer.account.logoutConfirm');
    }

    public function editProfile()
    {
        //id cua customers dang dang nhap
        $id = Auth::guard('customer')->user()->id;
        //lay ban ghi
        $customer = Customer::find($id);
        return view('Customer.profiles.profile', [
            'customer' => $customer
        ]);
    }

    public function updateProfile(Customer $request)
    {
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'phone', $request->phone);
        $array = Arr::add($array, 'gender', $request->gender);
        $array = Arr::add($array, 'address', $request->address);

        //id cua customer dang dang nhap
        $id = Auth::guard('customer')->user()->id;
        //lay ban ghi
        $customer = Customer::find($id);
        $customer->update($array);
        //Quay về danh sách
        return Redirect::route('Customer.profiles.profile');
    }

    public function index()
    {
        $customer = Customer::get();
        return view('admin.customer_manager.index', compact('customer'));
    }

    public function delete(int $id)
    {
        $customer= Customer::FindOrFail($id);
        $customer->delete();
        return redirect()->back()->with('status','Customer Deleted');
    }

    public function showOrderHistory()
    {
        //id cua customer dang dang nhap
        $id = Auth::guard('customer')->user()->id;
        //lay ban ghi
        $customer = Customer::find($id);
        $orders = Order::where('customer_id', $id)->orderBy('status')->paginate(2);

        return view('Customer.carts.orderHistory', [
            'customer' => $customer,
            'orders' => $orders,
        ]);
    }

    public function orderDetail(Order $order)
    {
        //id cua customer dang dang nhap
        $id = Auth::guard('customer')->user()->id;
        //lay ban ghi
        $customer = Customer::find($id);
        $orderId = $order->id;
        $orderDetails = DB::table('order_details')
            ->where('order_id', '=', $orderId)
            ->join('books', 'order_details.book_id', '=', 'books.id')
            ->get();

        $orderAmount = 0;
        $orderItems = 0;
        foreach ($orderDetails as $detail) {
            $orderItems += $detail->sold_quantity;
            $orderAmount += $detail->sold_price * $detail->sold_quantity;
        }
        $orderTotal = $orderAmount + 10;

        return view('Customer.carts.orderDetails', [
            'order' => $order,
            'order_details' => $orderDetails,
            'order_item' => $orderItems,
            'order_amount' => $orderAmount,
            'order_total' => $orderTotal,
            'customer' => $customer,
        ]);
    }

}



