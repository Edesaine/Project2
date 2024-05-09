<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\LoginCheckingCustomer;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;

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

//Admin
Route::get('author/index',[\App\Http\Controllers\AuthorController::class,'index'])->middleware('AdminLogged');
Route::get('author/create',[\App\Http\Controllers\AuthorController::class,'create'])->middleware('AdminLogged');
Route::post('author/create',[\App\Http\Controllers\AuthorController::class,'store'])->middleware('AdminLogged');
Route::get('author/{id}/edit',[\App\Http\Controllers\AuthorController::class,'edit'])->middleware('AdminLogged');
Route::put('author/{id}/edit',[\App\Http\Controllers\AuthorController::class,'update'])->middleware('AdminLogged');
Route::get('author/{id}/delete',[\App\Http\Controllers\AuthorController::class,'delete'])->middleware('AdminLogged');

Route::get('publisher/index',[\App\Http\Controllers\PublisherController::class,'index'])->middleware('AdminLogged');
Route::get('publisher/create',[\App\Http\Controllers\PublisherController::class,'create'])->middleware('AdminLogged');
Route::post('publisher/create',[\App\Http\Controllers\PublisherController::class,'store'])->middleware('AdminLogged');
Route::get('publisher/{id}/edit',[\App\Http\Controllers\PublisherController::class,'edit'])->middleware('AdminLogged');
Route::put('publisher/{id}/edit',[\App\Http\Controllers\PublisherController::class,'update'])->middleware('AdminLogged');
Route::get('publisher/{id}/delete',[\App\Http\Controllers\PublisherController::class,'delete'])->middleware('AdminLogged');

Route::get('category/index',[\App\Http\Controllers\CategoryController::class,'index'])->middleware('AdminLogged');
Route::get('category/create',[\App\Http\Controllers\CategoryController::class,'create'])->middleware('AdminLogged');
Route::post('category/create',[\App\Http\Controllers\CategoryController::class,'store'])->middleware('AdminLogged');
Route::get('category/{id}/edit',[\App\Http\Controllers\CategoryController::class,'edit'])->middleware('AdminLogged');
Route::put('category/{id}/edit',[\App\Http\Controllers\CategoryController::class,'update'])->middleware('AdminLogged');
Route::get('category/{id}/delete',[\App\Http\Controllers\CategoryController::class,'delete'])->middleware('AdminLogged');


Route::get('customer/index',[\App\Http\Controllers\CustomerController::class,'index'])->middleware('AdminLogged');
Route::get('customer/{id}/delete',[\App\Http\Controllers\CustomerController::class,'delete'])->middleware('AdminLogged');

Route::get('book/index',[BookController::class,'index'])->middleware('AdminLogged');
Route::get('book/create',[BookController::class,'create'])->middleware('AdminLogged');
Route::post('book/create',[BookController::class,'store'])->middleware('AdminLogged');
Route::get('book/{id}/edit',[BookController::class,'edit'])->middleware('AdminLogged');
Route::put('book/{id}/edit',[BookController::class,'update'])->middleware('AdminLogged');
Route::get('book/{id}/delete',[BookController::class,'delete'])->middleware('AdminLogged');

Route::get('/adminlogin', [App\Http\Controllers\AdminAuthController::class,'adminlogin']);
Route::post('/adminlogin_process', [App\Http\Controllers\AdminAuthController::class,'loginprocess'])->name('loginprocess');
Route::get('/logout', [App\Http\Controllers\AdminAuthController::class,'logout'])->middleware('AdminLogged');

Route::get('/admin_manage-panel', [DashboardController::class, 'index'])->name('admin_manage-panel');
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index']);


Route::middleware(LoginCheckingCustomer::class)->group(function () {
    Route::get('/profile', [CustomerController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');

    Route::get('/orders_history', [CustomerController::class, 'showOrderHistory'])->name('Customer.carts.orderHistory');
    Route::get('/order_detail/{order}', [CustomerController::class, 'orderDetail'])->name('Customer.carts.orderDetails');
    Route::get('/cancel_order/{order}', [OrderController::class, 'cancelOrder'])->name('Customer.carts.cancelOrder');

    Route::get('/change_password', [CustomerController::class, 'editPassword'])->name('customer.pwdEdit');
    Route::put('/change_password', [CustomerController::class, 'updatePassword'])->name('customer.pwdUpdate');

    Route::get('/cart', [BookController::class, 'cart'])->name('Customer.carts.cart');
    Route::get('/addToCart/{id}', [BookController::class, 'addToCart'])->name('Customer.products.addToCart');
    Route::get('/addToCartAjax/{id}', [BookController::class, 'addToCartAjax'])->name('Customer.products.addToCartAjax');
    Route::get('/updateCartQuantity/{id}', [BookController::class, 'updateCartQuantity'])->name('Customer.products.updateCartQuantity');
    Route::get('/deleteFromCart/{id}', [BookController::class, 'deleteFromCart'])->name('Customer.products.deleteFromCart');
    Route::get('/deleteAllFromCart', [BookController::class, 'deleteAllFromCart'])->name('Customer.products.deleteAllFromCart');

    Route::get('/checkout', [BookController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'checkoutProcess'])->name('checkoutProcess');
});

Route::get('/register', [CustomerController::class, 'register'])->name('Customer.account.register');
Route::post('/register', [CustomerController::class, 'registerProcess'])->name('Customer.account.registerProcess');

Route::get('/login', [CustomerController::class, 'login'])->name('Customer.account.login');
Route::post('/login', [CustomerController::class, 'loginProcess'])->name('Customer.account.loginProcess');

Route::get('/logout', [CustomerController::class, 'logout'])->name('Customer.account.logout');
Route::get('/forgot_password', [CustomerController::class, 'forgotPassword'])->name('customer.forgotPassword');

Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('book/{id}', [BookController::class, 'bookDetail'])->name('Customer.product.detail');
