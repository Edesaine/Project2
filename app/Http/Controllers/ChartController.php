<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChartController extends Controller
{
    public function index()
    {
        $LoginName = Session::get('loginname');
        $LoginEmail = Session::get('loginemail');

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

        $categorySalesData = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('books', 'order_details.book_id', '=', 'books.id')
            ->join('categorybook', 'books.id', '=', 'categorybook.book_id')
            ->join('categories', 'categorybook.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(order_details.sold_quantity) AS total_sold'))
            ->groupBy('categories.name')
            ->get();

        $totalSold = $categorySalesData->sum('total_sold');

        $secondChartData = [];
        foreach ($categorySalesData as $categorySale) {
            $percentage = ($categorySale->total_sold / $totalSold) * 100;
            $secondChartData[] = [
                'label' => $categorySale->name,
                'y' => round($percentage, 2),
            ];
        }

        $authorSalesData = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('books', 'order_details.book_id', '=', 'books.id')
            ->join('authorbook', 'books.id', '=', 'authorbook.book_id')
            ->join('authors', 'authorbook.author_id', '=', 'authors.id')
            ->select('authors.name', DB::raw('SUM(order_details.sold_quantity) AS sold_total'))
            ->groupBy('authors.name')
            ->get();

        $soldTotal = $authorSalesData->sum('sold_total');

        $thirdChartData = [];
        foreach ($authorSalesData as $authorSale) {
            $percentage = ($authorSale->sold_total / $soldTotal) * 100;
            $thirdChartData[] = [
                'label' => $authorSale->name,
                'y' => round($percentage, 2),
            ];
        }

        return view('Admin.layouts.charts', [
            'firstChartData' => $firstChartData, 'secondChartData' => $secondChartData, 'thirdChartData' => $thirdChartData],
            compact('LoginName', 'LoginEmail'));
    }
}
