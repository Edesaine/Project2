<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\LoginCheckingCustomer;

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

Route::get('author/index',[\App\Http\Controllers\AuthorController::class,'index']);
Route::get('author/create',[\App\Http\Controllers\AuthorController::class,'create']);
Route::post('author/create',[\App\Http\Controllers\AuthorController::class,'store']);
Route::get('author/{id}/edit',[\App\Http\Controllers\AuthorController::class,'edit']);
Route::put('author/{id}/edit',[\App\Http\Controllers\AuthorController::class,'update']);
Route::get('author/{id}/delete',[\App\Http\Controllers\AuthorController::class,'delete']);

Route::get('publisher/index',[\App\Http\Controllers\PublisherController::class,'index']);
Route::get('publisher/create',[\App\Http\Controllers\PublisherController::class,'create']);
Route::post('publisher/create',[\App\Http\Controllers\PublisherController::class,'store']);
Route::get('publisher/{id}/edit',[\App\Http\Controllers\PublisherController::class,'edit']);
Route::put('publisher/{id}/edit',[\App\Http\Controllers\PublisherController::class,'update']);
Route::get('publisher/{id}/delete',[\App\Http\Controllers\PublisherController::class,'delete']);

Route::get('customer/index',[\App\Http\Controllers\CustomerController::class,'index']);
Route::post('customer/index',[\App\Http\Controllers\CustomerController::class,'store']);

Route::get('book/index',[\App\Http\Controllers\BookController::class,'index']);
Route::get('book/create',[\App\Http\Controllers\BookController::class,'create']);
Route::post('book/create',[\App\Http\Controllers\BookController::class,'store']);
Route::get('book/{id}/edit',[\App\Http\Controllers\BookController::class,'edit']);
Route::put('book/{id}/edit',[\App\Http\Controllers\BookController::class,'update']);
Route::get('book/{id}/delete',[\App\Http\Controllers\BookController::class,'delete']);

Route::middleware(LoginCheckingCustomer::class)->group(function () {
    Route::get('/profile', [CustomerController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/register', [CustomerController::class, 'register'])->name('Customer.account.register');
Route::post('/register', [CustomerController::class, 'registerProcess'])->name('Customer.account.registerProcess');

Route::get('/login', [CustomerController::class, 'login'])->name('Customer.account.login');
Route::post('/login', [CustomerController::class, 'loginProcess'])->name('Customer.account.loginProcess');


Route::get('/register', [CustomerController::class, 'register'])->name('Customer.account.register');
Route::post('/register', [CustomerController::class, 'registerProcess'])->name('Customer.account.registerProcess');

Route::get('/login', [CustomerController::class, 'login'])->name('Customer.account.login');
Route::post('/login', [CustomerController::class, 'loginProcess'])->name('Customer.account.loginProcess');
