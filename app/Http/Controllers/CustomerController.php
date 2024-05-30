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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


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
            $array = Arr::add($array, 'image', 'catmeme.jpg');
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

    public function updateProfile(Request $request)
    {
        $id = Auth::guard('customer')->id();
        $customer = Customer::find($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|max:255|unique:customer,email,' . $id,
            // lay id customer de bo qua unique cho email cua customer dang edit
            'phone' => 'required|max:20',
            'gender' => 'required',
            'address' => 'required'
        ]);

        if ($validated) {
            $imagePath = "";
            //Kiểm tra nếu đã chọn ảnh thì Lấy tên ảnh đang được chọn
            //không chọn ảnh thì sẽ lấy tên ảnh cũ trên db
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
            } else {
                $imagePath = $customer->image;
            }

            if (!Storage::exists('public/storage/customers/image/')) {
                Storage::createDirectory('public/storage/customers/image/');
            }
            //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
            if (!Storage::exists('public/storage/customers/image/' . $imagePath)) {
                Storage::putFileAs('public/storage/customers/image/', $request->file('image'), $imagePath);
            }

            //Lấy dữ liệu trong form và update lên db
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'phone', $request->phone);
            $data = Arr::add($data, 'gender', $request->gender);
            $data = Arr::add($data, 'address', $request->address);
            $data = Arr::add($data, 'image', $imagePath);

            //id cua customer dang dang nhap
            $id = Auth::guard('customer')->user()->id;
            //lay ban ghi
            $customer = Customer::find($id);
            $customer->update($data);
            //Quay về danh sách
            return to_route('profile')->with('success', 'Update account successfully!');
        }else{
            return back()->with('failed', 'Invalid adjustment!');
        }
    }
    public function changePassword()
    {
        $id = Auth::guard('customer')->id();
        $customer = Customer::find($id);
        return view('Customer.profiles.changePassword', [
            'customer' => $customer
        ]);
    }

    public function updatePassword(Request $request)
    {
        $oldPassword = $request->old_password;
        $newPassword = $request->new_password;
        $confirmNewPassword = $request->confirm_new_password;

        $customer = Auth::guard('customer')->user();
        $currentPassword = $customer->getAuthPassword();

        //kiem tra bo trong
        if ($oldPassword == "" || $newPassword == "" || $confirmNewPassword == "") {
            return back()->with('failed', 'Please enter all the fields!');
        }

        if (!Hash::check($oldPassword, $currentPassword)) {
            return back()->with('failed', 'Wrong old password!');
        }

        if ($confirmNewPassword != $newPassword) {
            return back()->with('failed', 'Confirm new password is not the same as new password!');
        }

        $hashedNewPassword = Hash::make($newPassword);
        $customer->update(['password', $hashedNewPassword]);

        return back()->with('success', 'Change password successfully!');
    }


    public function index(Request $request)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        $search='%%';
        if($request->search){
            $search='%'.$request->search.'%';
        }
        $customer = DB::table('customer')
            ->select('customer.*')
            ->where('name','like',$search)
            ->get();
        return view('admin.customer_manager.index', compact('customer','LoginName','LoginEmail'));
    }

    public function edit(Customer $customer)
    {
        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
        return view('admin.customer_manager.edit', [
            'customer' => $customer
        ], compact('LoginEmail','LoginName'));
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = "";
            //Kiểm tra nếu đã chọn ảnh thì Lấy tên ảnh đang được chọn
            //không chọn ảnh thì sẽ lấy tên ảnh cũ trên db
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
            } else {
                $imagePath = $customer->image;
            }
            //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
            if (!Storage::exists('public/admin/customers/' . $imagePath)) {
                Storage::putFileAs('public/admin/customers/', $request->file('image'), $imagePath);
            }
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'email', $request->email);
//            //kiem tra neu password khong thay doi thi ko update password
//            if ($request->password != $customer->password) {
//                $data = Arr::add($data, 'password', Hash::make($request->password));
//            }
            $data = Arr::add($data, 'phone', $request->phone);
            $data = Arr::add($data, 'status', $request->status);
            $data = Arr::add($data, 'image', $imagePath);
            $customer->update($data);

//           update xong -> logout customer
            Auth::guard('customer')->logout();
            session()->forget('customer');

            //log
            return to_route('admin.customer_manager.index')->with('success', 'Customer updated successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function showOrderHistory()
    {
        //id cua customer dang dang nhap
        $id = Auth::guard('customer')->user()->id;
        //lay ban ghi
        $customer = Customer::find($id);
        $orders = Order::where('customer_id', $id)->orderBy('status')->paginate(10);

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
    public function ChangeStatus(int $id)
    {
        $customer = Customer::findOrFail($id);
        if($customer->account_status==0){
            $customer->update([
                'account_status'=>1
            ]);
        } else{
            $customer->update([
                'account_status'=>0
            ]);
        }
        return redirect()->back();
    }

}



