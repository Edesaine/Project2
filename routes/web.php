<?php

use App\Http\Controllers\DischargeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\LoginCheckingCustomer;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckLoginAdmin;
use App\Http\Middleware\CustomerLoginAlready;
use App\Http\Controllers\ChartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Customer.Layout.index');
})->name('home');

Route::get('/layout', function () {
    return view('Customer.Layout.index');
})->name('layout_page');

Route::post('/', [\App\Http\Controllers\SortBookController::class, 'index'])->name('Customer.books.search');

//Admin
    Route::get('author/index', [\App\Http\Controllers\AuthorController::class, 'index'])->middleware('AdminLogged');
    Route::get('author/create', [\App\Http\Controllers\AuthorController::class, 'create'])->middleware('AdminLogged');
    Route::post('author/create', [\App\Http\Controllers\AuthorController::class, 'store'])->middleware('AdminLogged');
    Route::get('author/{id}/edit', [\App\Http\Controllers\AuthorController::class, 'edit'])->middleware('AdminLogged');
    Route::put('author/{id}/edit', [\App\Http\Controllers\AuthorController::class, 'update'])->middleware('AdminLogged');
    Route::get('author/{id}/delete', [\App\Http\Controllers\AuthorController::class, 'delete'])->middleware('AdminLogged');

    Route::get('publisher/index', [\App\Http\Controllers\PublisherController::class, 'index'])->middleware('AdminLogged');
    Route::get('publisher/create', [\App\Http\Controllers\PublisherController::class, 'create'])->middleware('AdminLogged');
    Route::post('publisher/create', [\App\Http\Controllers\PublisherController::class, 'store'])->middleware('AdminLogged');
    Route::get('publisher/{id}/edit', [\App\Http\Controllers\PublisherController::class, 'edit'])->middleware('AdminLogged');
    Route::put('publisher/{id}/edit', [\App\Http\Controllers\PublisherController::class, 'update'])->middleware('AdminLogged');
    Route::get('publisher/{id}/delete', [\App\Http\Controllers\PublisherController::class, 'delete'])->middleware('AdminLogged');

    Route::get('category/index', [\App\Http\Controllers\CategoryController::class, 'index'])->middleware('AdminLogged');
    Route::get('category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->middleware('AdminLogged');
    Route::post('category/create', [\App\Http\Controllers\CategoryController::class, 'store'])->middleware('AdminLogged');
    Route::get('category/{id}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->middleware('AdminLogged');
    Route::put('category/{id}/edit', [\App\Http\Controllers\CategoryController::class, 'update'])->middleware('AdminLogged');
    Route::get('category/{id}/delete', [\App\Http\Controllers\CategoryController::class, 'delete'])->middleware('AdminLogged');

Route::get('order/index',[\App\Http\Controllers\OrderController::class,'index'])->middleware('AdminLogged');
Route::get('order/create',[\App\Http\Controllers\OrderController::class,'create'])->middleware('AdminLogged');
Route::post('order/create',[\App\Http\Controllers\OrderController::class,'store'])->middleware('AdminLogged');
Route::get('order/{id}/edit',[\App\Http\Controllers\OrderController::class,'edit'])->middleware('AdminLogged');
Route::put('order/{id}/edit',[\App\Http\Controllers\OrderController::class,'update'])->middleware('AdminLogged');
Route::get('order/{id}/delete',[\App\Http\Controllers\OrderController::class,'delete'])->middleware('AdminLogged');
Route::get('order/{id}/details',[\App\Http\Controllers\OrderController::class,'details'])->middleware('AdminLogged');
Route::put('order/{id}/details',[\App\Http\Controllers\OrderController::class,'ChangeStatus'])->middleware('AdminLogged');
Route::get('order/{id}/ChangeStatus',[\App\Http\Controllers\OrderController::class,'ChangeStatus'])->middleware('AdminLogged');
Route::get('order/approve_orders',[\App\Http\Controllers\OrderController::class,'approve'])->middleware('AdminLogged');
Route::get('order/{id}/ApproveOrder',[\App\Http\Controllers\OrderController::class,'ApproveOrder'])->middleware('AdminLogged');

Route::get('customer/index',[\App\Http\Controllers\CustomerController::class,'index'])->middleware('AdminLogged');
Route::post('customer/index',[\App\Http\Controllers\CustomerController::class,'store'])->middleware('AdminLogged');
Route::get('customer/{id}/delete',[\App\Http\Controllers\CustomerController::class,'delete'])->middleware('AdminLogged');
Route::get('customer/{id}/changestatus',[CustomerController::class,'ChangeStatus'])->middleware('AdminLogged');

Route::get('book/index',[BookController::class,'index'])->middleware('AdminLogged');
Route::get('book/create',[BookController::class,'create'])->middleware('AdminLogged');
Route::post('book/create',[BookController::class,'store'])->middleware('AdminLogged');
Route::get('book/{id}/additional-information',[BookController::class,'addinfomation'])->middleware('AdminLogged')->name('book.addinformation');
Route::post('book/additional-information',[BookController::class,'addinfomationprocess'])->middleware('AdminLogged');
Route::get('book/{id}/edit',[BookController::class,'edit'])->middleware('AdminLogged');
Route::put('book/{id}/edit',[BookController::class,'update'])->middleware('AdminLogged');
Route::get('book/{id}/changestatus',[BookController::class,'ChangeStatus'])->middleware('AdminLogged');


Route::get('book/{id}/detail',[BookController::class,'detail'])->middleware('AdminLogged');
Route::get('book/{id}/delete',[BookController::class,'delete'])->middleware('AdminLogged');

Route::get('/admin-login', [App\Http\Controllers\AdminAuthController::class,'adminlogin']);
Route::post('/adminlogin_process', [App\Http\Controllers\AdminAuthController::class,'loginprocess'])->name('loginprocess');
Route::get('/adminlogout', [App\Http\Controllers\AdminAuthController::class,'logout'])->middleware('AdminLogged');

Route::get('/admin_manage-panel', [DashboardController::class, 'index'])->name('admin_manage-panel');
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('AdminLogged');
Route::post('/dashboard/add-task', [DashboardController::class, 'addTask'])->name('dashboard.addTask');

//Customer
Route::middleware(LoginCheckingCustomer::class)->group(function () {
    Route::get('/profile', [CustomerController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');

    Route::get('/orders_history', [CustomerController::class, 'showOrderHistory'])->name('Customer.carts.orderHistory');
    Route::get('/order_detail/{order}', [CustomerController::class, 'orderDetail'])->name('Customer.carts.orderDetails');
    Route::get('/cancel_order/{order}', [OrderController::class, 'cancelOrder'])->name('Customer.carts.cancelOrder');

    Route::get('/changePassword',[CustomerController::class,'changePassword'])->name('Customer.changePassword');
    Route::put('/changePassword',[CustomerController::class, 'updatePassword'])->name('Customer.updatePassword');

    Route::get('/cart', [BookController::class, 'cart'])->name('Customer.carts.cart');
    Route::get('/addToCart/{id}', [BookController::class, 'addToCart'])->name('Customer.products.addToCart');
    Route::get('/addToCartAjax/{id}', [BookController::class, 'addToCartAjax'])->name('Customer.products.addToCartAjax');
    Route::get('/updateCartQuantity/{id}', [BookController::class, 'updateCartQuantity'])->name('Customer.products.updateCartQuantity');
    Route::get('/deleteFromCart/{id}', [BookController::class, 'deleteFromCart'])->name('Customer.products.deleteFromCart');
    Route::get('/deleteAllFromCart', [BookController::class, 'deleteAllFromCart'])->name('Customer.products.deleteAllFromCart');

    Route::get('/checkout', [BookController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'checkoutProcess'])->name('checkoutProcess');
});

//Discharge
Route::prefix('/discharge')->group(function () {
    Route::get('', [DischargeController::class, 'discharge'])->name('Customer.discharge');
    Route::post('', [DischargeController::class,'dischargeProcess'])->name('Customer.dischargeProcess');
    Route::get('/redirect', [DischargeController::class, 'dischargeRedirect'])->name('Customer.dischargeRedirect');
    Route::post('/vnpay', [DischargeController::class, 'vnpay_discharge'])->name('Customer.vnpay');
    Route::get('/dischargeSuccess', [DischargeController::class, 'dischargeSuccess'])->name('Customer.dischargeSuccess');
});

//Customer Account
Route::middleware([CustomerLoginAlready::class])->group(function(){
    Route::get('/register',[CustomerController::class, 'register'])->name('Customer.account.register');
    Route::post('/register',[CustomerController::class,'registerProcess'])->name('Customer.account.registerProcess');

    Route::get('/login',[CustomerController::class,'login'])->name('Customer.account.login');
    Route::post('/login',[CustomerController::class,'loginProcess'])->name('Customer.account.loginProcess');

    Route::get('/forgotPassword', [CustomerController::class,'forgotPassword'])->name('Customer.forgotPassword');
    Route::post('/forgotPassword',[CustomerController::class, 'forgotPasswordSendEmail'])->name('Customer.forgotPassword.sendEmail');
    Route::get('/forgotPassword/enterCode',[CustomerController::class, 'forgotPasswordEnterCode'])->name('Customer.forgotPassword.enterCode');
    Route::post('/forgotPassword/enterCode',[CustomerController::class,'forgotPasswordCheckCode'])->name('Customer.forgotPassword.checkCode');
    Route::get('/resetPassword',[CustomerController::class,'resetPassword'])->name('Customer.forgotPassword.resetPassword');
    Route::put('/resetPassword',[CustomerController::class,'resetPasswordProcess'])->name('Customer.forgotPassword.resetPasswordProcess');
});

Route::get('/logout', [CustomerController::class, 'logout'])->name('Customer.account.logout');
Route::get('/forgot_password', [CustomerController::class, 'forgotPassword'])->name('Customer.forgotPassword');

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/search',[App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('book/{id}', [BookController::class, 'bookDetail'])->name('Customer.product.detail');

Route::get('/charts', [ChartController::class, 'index'])->name('Admin.layouts.charts');
