<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        session([
            'myUrl' => url()->previous()
        ]);
        return view('Customer.account.login');
    }

    public function loginProcess(Request $request)
    {
        $accuracy = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        //check account status
        $cusEmail = $accuracy['email'];
        $cusAccount = Customer::where('email', '=', $cusEmail)->first();
        if ($cusAccount == null) {
            return Redirect::back()->with('failed', 'This email does not exist.');
        }
        $accountStatus = $cusAccount -> account_status;
        if ($accountStatus == 0) {
            return to_route('Customer.account.login')->with('failed', 'This account has been locked !')->withInput($request->input());
        }

        $account = $request->only(['email', 'password']);
        $check = Auth::guard('customer')->attempt($account);

        if ($check) {
            //Lấy thông tin của customer đang login
            $customer = Auth::guard('customer')->user();
            //Cho login
            Auth::guard('customer')->login($customer);
            //Ném thông tin customer đăng nhập lên session
            session(['customer' => $customer]);
            return Redirect::route('profile')->with('success', 'Logged in successfully');
        } else {
            //cho quay về trang login
            return Redirect::back()->with('failed', 'You entered the wrong email or password.')->withInput($request->input());
        }
    }

    public function logout()
    {
        if (!Auth::guard('customer')->check()) {
            return Redirect::route('Customer.Layout.index')->with('success', 'You are logged out.  ');
        }
        Auth::guard('customer')->logout();
        session()->forget('customer');
        return view('Customer.account.logoutConfirm');
    }

    public function editProfile()
    {
        // Check if the user is authenticated
        if (Auth::guard('customer')->check()) {
            // Get the id of the authenticated customer
            $id = Auth::guard('customer')->user()->id;

            // Fetch the customer record
            $customer = Customer::find($id);

            return view('Customer.profiles.profile', [
                'customer' => $customer
            ]);
        } else {
            // Redirect to login page or handle unauthenticated user case
            return redirect()->route('Customer.account.login')->with('error', 'You need to log in to access this page.');
        }
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

            if (!Storage::exists('public/customers/image')) {
                Storage::createDirectory('public/customers/image');
            }
            //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
            if (!Storage::exists('public/customers/image/' . $imagePath)) {
                Storage::putFileAs('public/customers/image/', $request->file('image'), $imagePath);
            }

            // Lưu đường dẫn vào cơ sở dữ liệu
            $customer->image = $customer . $imagePath;
            $customer->save();


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


    public function forgotPassword()
    {
        return view('Customer.account.forgotPassword');
    }

    public function forgotPasswordSendEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        if ($validated) {
            $resetEmail = $request->email;
            $emailList = Customer::pluck('email')->toArray();
            if (!in_array($resetEmail, $emailList)) {
                return back()->with('failed', 'Email doesn\'t exist!');
            }

            $customer = Customer::where('email', '=', $resetEmail)->first();
            $resetCode = rand(100000, 999999);
            Mail::to($customer)->send((new ForgotPassword($resetCode)));
            session()->put('resetEmail', $resetEmail);
            session()->put('resetCode', $resetCode);
            return Redirect::route('Customer.forgotPassword.enterCode')->with('message','Please check your email for reset new password');
        }
    }

    public function forgotPasswordEnterCode()
    {
        if (!session()->has('resetCode')) {
            return Redirect::back()->with('failed', 'You have not entered your email yet...');
        }
        return view('Customer.account.forgotPasswordEnterCode');
    }

    public function forgotPasswordCheckCode(Request $request)
    {
        $validated = $request->validate([
            'reset_code' => 'integer'
        ]);

        if ($validated) {
            $resetCode = session()->get('resetCode');
            $inputCode = $request->reset_code;

            if ($inputCode != $resetCode) {
                return back()->with('failed', 'Wrong code !');
            }
            session()->forget('resetCode');
            session()->put('reset_ready', true);
            return Redirect::route('Customer.forgotPassword.resetPassword');
        }
    }

    public function resetPassword()
    {
        if (!session()->has('reset_ready')) {
            return Redirect::back()->with('failed', 'You have not entered the code to reset your password...');
        }
        return view('Customer.account.resetPassword');
    }

    public function resetPasswordProcess(Request $request)
    {
        $newPassword = $request->new_password;
        $confirmNewPassword = $request->confirm_new_password;
        $validated = $request->validate([
            'new_password' => 'min:6',
            'confirm_new_password' => 'min:6',
        ]);

        if ($validated) {
            if ($confirmNewPassword != $newPassword) {
                    return back()->with('failed', 'Re-entered password does not match!');
            }

            $hashedNewPassword = Hash::make($newPassword);

            $resetEmail = session()->get('resetEmail');
            $customer = Customer::where('email', '=', $resetEmail)->firstOrFail();
            session()->forget('resetEmail');

            $customer->update([
                'password' => $hashedNewPassword
            ]);

            session()->forget('reset_ready');
            return Redirect::route('Customer.account.login')->with('success', 'Password reset successful');
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

    //Admin
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
            ->paginate(6);
        return view('admin.customer_manager.index', compact('customer','LoginName','LoginEmail'));
    }

    public function store(CustomerStoreRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/storage/customers/image/', $file, $imagePath);

            $data = [
                'name' => $validatedData['name'],
                'gender' => $validatedData['gender'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'phone' => $validatedData['phone'],
                'account_status' => 1,
                'address' => $validatedData['address'],
                'image' => $imagePath
            ];

            $customer = Customer::create($data);

            if ($customer) {
                return redirect()->back()->with('success', 'Customer created successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to create customer.');
            }
        }
    }

    public function edit(Customer $customer)
    {

        $LoginName= Session::get('loginname');
        $LoginEmail= Session::get('loginemail');
//        dd($customer);
        return view('admin.customer_manager.edit', [
            'customer' => $customer
        ], compact('LoginEmail','LoginName'));
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = $customer->image;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagePath = time().'.'.$file->getClientOriginalExtension();
                $file->storeAs('public/storage/customers/image/', $imagePath);
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone' => $request->phone,
                'account_status' => 1,
                'image' => $imagePath,
            ];

            // Kiểm tra nếu password được thay đổi
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $customer->update($data);

            // Trả về với thông báo thành công
            return redirect()->route('admin.customer_manager.index')->with('success', 'Customer updated successfully!');
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

        $orders = Order::where('customer_id', $id)->orderBy('status')->with('payment')->paginate(4);

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

        $orders = Order::where('customer_id', $id)->orderBy('status')->with('payment')->paginate(4);


        $orderAmount = 0;
        $orderItems = 0;
        foreach ($orderDetails as $detail) {
            $orderItems += $detail->sold_quantity;
            $orderAmount += $detail->sold_price * $detail->sold_quantity;
        }
        $orderTotal = $orderAmount ;

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
        if($customer->account_status == 0){
            $customer->update([
                'account_status' => 1
            ]);
        } else{
            $customer->update([
                'account_status' => 0
            ]);
        }
        return redirect()->back();
    }

}



