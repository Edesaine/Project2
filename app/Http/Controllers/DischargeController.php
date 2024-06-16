<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DischargeController extends Controller
{
    public function discharge()
    {
        // Khởi tạo giỏ hàng và tổng tiền
        $carts = [];
        $totalPrice = Session::get('amount');

        // Kiểm tra nếu giỏ hàng không rỗng
        if (Session::has('cart')) {
            $carts = Session::get('cart');

            // Lặp qua từng sách trong giỏ hàng
            foreach ($carts as $bookId => $book) {
                // Kiểm tra số lượng sách hiện tại
                $countCurrentBook = Book::where('id', $bookId)
                    ->where('status', 0)
                    ->count();
                $cartQuantity = $book['quantity'];

                // Nếu sách đã hết hàng
                if ($countCurrentBook == 0) {
                    unset($carts[$bookId]);
                    Session::put('cart', $carts);
                    return Redirect::route('Customer.carts.cart')->with('failed', 'An error occurred: the book is out of stock!');
                }
                // Nếu số lượng sách hiện tại ít hơn số lượng trong giỏ hàng
                else if ($countCurrentBook < $cartQuantity) {
                    $carts[$bookId]['quantity'] = $countCurrentBook;
                    Session::put('cart', $carts);
                    return Redirect::route('Customer.carts.cart')->with('failed', 'An error occurred: the book quantity has been updated due to stock limitations!');
                }
            }
        } else {
            $carts = null;
        }

        if (empty($carts)) {
            return Redirect::route('Customer.carts.cart')->with('failed', 'Your cart is empty.');
        }

        return view('Customer.discharge.discharge', compact('carts', 'totalPrice'));
    }


    public function dischargeProcess(Request $request)
    {
        if (!Session::has('cart')) {
            return Redirect::route('Customer.carts.cart')->with('failed', 'Cart is empty!');
        }

        $carts = Session::get('cart');
        foreach ($carts as $bookId => $book) {
            $countCurrentBook = Book::where('id', $bookId)
                ->where('status', 0)
                ->count();
            $cartQuantity = $book['quantity'];

            if ($countCurrentBook == 0) {
                unset($carts[$bookId]);
                Session::put('cart', $carts);
                return Redirect::route('Customer.carts.cart');
            } elseif ($countCurrentBook < $cartQuantity) {
                $carts[$bookId]['quantity'] = $countCurrentBook;
                Session::put('cart', $carts);
                return Redirect::route('Customer.carts.cart')->with('failed', 'An error occurred: the book is out of stock!');
            }
        }

        Session::put('payment_data', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'note' => $request->note,
            'amount' => $request->total_price,
        ]);

        if ($request->has('pay_later')) {
            Session::put('pay_later', true);
            return Redirect::route('Customer.carts.orderHistory');
        }

        return Redirect::route('Customer.paymentRedirect');
    }

    public function dischargeRedirect()
    {
        return view('Customer.discharge.payment_redirect');
    }

    public function vnpay_discharge()
    {
        // bank : 	9704198526191432198
        //check neu ko co payment
        if (!Session::exists('payment_data')) {
            return Redirect::route('Customer.carts.cart');
        }

        //lay gia (vnd = * 100)
        $price = Session::get('payment_data')['total_price'] * 100;

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/orders_history";
        $vnp_TmnCode = "Y7BJBW4Q"; //Mã website tại VNPAY
        $vnp_HashSecret = "1ON5D5PSA7K2AC4AZWO6W74EZCN1VLLD"; //Chuỗi bí mật

        $vnp_TxnRef = rand(11111, 999999999);
        $vnp_OrderInfo = 'Pay for books at Infinite Knowledge';
        $vnp_OrderType = 'Order';
        $vnp_Amount = $price;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function dischargeSuccess()
    {
        return view('Customer.discharge.dischargeSuccess');
    }
}
