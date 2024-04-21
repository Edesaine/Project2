<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Requests\CustomerStoreRequest;
use App\Requests\UpdateCustomerRequest;
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
            $array = Arr::add($array, 'address', $request->address);
            $array = Arr::add($array, 'status', 1);
            //Lấy dữ liệu từ form và lưu lên db
            Customer::create($array);

            return Redirect::route('Customer.account.login');
        } else {
            //cho quay về trang login
            return Redirect::back();
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

    public function editProfile()
    {
        //id cua customers dang dang nhap
        $id = Auth::guard('customers')->user()->id;
        //lay ban ghi
        $customer = Customer::find($id);
        return view('Customer.account.login', [
            'customers' => $customer
        ]);
    }

    public function index()
    {
        $customers = Customer::get();
        return view('admin.customer_manager.index', compact('customers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255|string',
            'email'=>'required|max:255|string',
            'phone'=>'required|max:10|string',
            'password'=>'required|max:20|string',
            'gender'=>'required|max:1|int',
            'address'=>'required|max:255|string',
            'account_status' => 'sometimes'
        ]);
        Customer::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'gender'=>$request->gender,
            'address'=>$request->address,
            'account_status' => $request->account_status == true ? 1:0,
        ]);
        return redirect('customer/index')->with('status','Customer Added');
    }
    public function edit(int $id)
    {
        $customers = Customer::findorFail($id);
        return view('customer.edit',compact('customers'));
    }
    public function update(Request $request,int $id)
    {
        $request->validate([
            'name'=>'required|max:255|string',
            'email'=>'required|max:255|string',
            'phone'=>'required|max:10|string',
            'password'=>'required|max:20|string',
            'gender'=>'required|max:1|int',
            'address'=>'required|max:255|string',
        ]);
        Customer::findorFail($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'gender'=>$request->gender,
            'address'=>$request->address,
        ]);
        return redirect()->back()->with('status','Customer Updated');
    }
    public function delete(int $id)
    {
        $customers = Customer::FindOrFail($id);
        $customers->delete();
        return redirect()->back()->with('status','Customer Deleted');
    }
}



