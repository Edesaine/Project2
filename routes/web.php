<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\LoginCheckingCustomer;
use App\Http\Controllers\HomeController;

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

Route::get('customer/index',[\App\Http\Controllers\CustomerController::class,'index'])->middleware('AdminLogged');
Route::post('customer/index',[\App\Http\Controllers\CustomerController::class,'store'])->middleware('AdminLogged');

Route::get('book/index',[\App\Http\Controllers\BookController::class,'index'])->middleware('AdminLogged');
Route::get('book/create',[\App\Http\Controllers\BookController::class,'create'])->middleware('AdminLogged');
Route::post('book/create',[\App\Http\Controllers\BookController::class,'store'])->middleware('AdminLogged');
Route::get('book/{id}/edit',[\App\Http\Controllers\BookController::class,'edit'])->middleware('AdminLogged');
Route::put('book/{id}/edit',[\App\Http\Controllers\BookController::class,'update'])->middleware('AdminLogged');
Route::get('book/{id}/delete',[\App\Http\Controllers\BookController::class,'delete'])->middleware('AdminLogged');

Route::get('/adminlogin', [App\Http\Controllers\AdminAuthController::class,'adminlogin']);
Route::post('/adminlogin_process', [App\Http\Controllers\AdminAuthController::class,'loginprocess'])->name('loginprocess');
Route::get('/logout', [App\Http\Controllers\AdminAuthController::class,'logout'])->middleware('AdminLogged');






Route::middleware(LoginCheckingCustomer::class)->group(function () {
    Route::get('/profile', [CustomerController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/register', [CustomerController::class, 'register'])->name('Customer.account.register');
Route::post('/register', [CustomerController::class, 'registerProcess'])->name('Customer.account.registerProcess');

Route::get('/login', [CustomerController::class, 'login'])->name('Customer.account.login');
Route::post('/login', [CustomerController::class, 'loginProcess'])->name('Customer.account.loginProcess');

Route::get('/logout', [CustomerController::class, 'logout'])->name('Customer.account.logout');
Route::get('/forgot_password', [CustomerController::class, 'forgotPassword'])->name('customer.forgotPassword');

/*Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
