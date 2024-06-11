<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Task;
use App\Models\Admin;
use App\Models\Book;
use App\Models\OrderDetail;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $LoginName = Session::get('loginname');
        $LoginEmail = Session::get('loginemail');
        $admins=Admin::get();

        // Lấy dữ liệu thống kê
        $soldProductsCount = OrderDetail::sum('sold_quantity');
        $ordersCount = Order::count();
        $customersCount = Customer::count();
        $revenue = Order::sum('amount');

        // Tạo đối tượng thống kê
        $stats = new \stdClass();
        $stats->soldProductsCount = $soldProductsCount;
        $stats->ordersCount = $ordersCount;
        $stats->customersCount = $customersCount;
        $stats->revenue = $revenue;

        $soldProducts = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('books', 'order_details.book_id', '=', 'books.id')
            ->select(
                'orders.date_buy as order_date',
                'orders.id as order_id',
                'books.name as product_name',
                'order_details.sold_price as price',
                'order_details.sold_quantity as quantity',
                DB::raw('order_details.sold_price * order_details.sold_quantity as total_price')
            )
            ->get();

        $salesData = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->select(DB::raw('DATE(orders.date_buy) AS order_date'), DB::raw('SUM(order_details.sold_quantity) AS total_sold'))
            ->groupBy('order_date')
            ->orderBy('order_date')
            ->get();


        // Chuyển đổi dữ liệu thành mảng dữ liệu phù hợp
        $firstChartData = [];
        foreach ($salesData as $sale) {
            $firstChartData[] = [
                'label' => $sale->order_date,
                'y' => $sale->total_sold,
            ];
        }

        $topBooks = DB::table('order_details')
            ->join('books', 'order_details.book_id', '=', 'books.id')
            ->select('books.name', 'books.image', DB::raw('SUM(order_details.sold_quantity) AS total_sold'))
            ->groupBy('books.id', 'books.name', 'books.image')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        // Lấy top 5 khách hàng mua nhiều nhất trong 1 tháng
        $currentMonth = Carbon::now()->month;
        $topCustomers = Order::join('customer', 'orders.customer_id', '=', 'customer.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select(
                'customer.name',
                'customer.email',
                DB::raw('SUM(order_details.sold_quantity) as total_sold')
            )
            ->whereMonth('orders.date_buy', $currentMonth)
            ->groupBy('customer.id', 'customer.name', 'customer.email')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->get();

        $lowStockBooks = Book::orderBy('quantity', 'asc')
            ->take(5)
            ->get();

        $tasks = Task::all();

        return view('admin.layouts.dashboard', [
            'firstChartData' => $firstChartData,
            /*'secondChartData' => $secondChartData,*/], compact('LoginName', 'LoginEmail',
            'stats','soldProducts','topBooks','tasks','topCustomers','lowStockBooks','admins'));
    }

    public function addTask(Request $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->time = $request->input('time');
        $task->date = $request->input('date');
        $task->status = $request->input('status');
        $task->admin_id = $request->input('admin_id'); // Giả sử bạn có user_id

        $task->save();

        return redirect()->back()->with('success', 'Task added successfully!');
    }

}
