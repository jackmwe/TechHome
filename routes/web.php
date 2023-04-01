<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/products', 'App\Http\Controllers\ProductsController'); 

Route::resource('/suppliers', 'App\Http\Controllers\SuppliersController'); 

Route::resource('/companies', 'App\Http\Controllers\CompanyController'); 

Route::resource('/transactions', 'App\Http\Controllers\TransactionController'); 

Route::resource('/users', 'App\Http\Controllers\UserController');

Route::resource('/orders', 'App\Http\Controllers\OrderController');

// Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders'); //orders.index
// Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products'); //products.index
// Route::get('/suppliers', [App\Http\Controllers\SuppliersController::class, 'index'])->name('suppliers'); //suppliers.index
// Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies'); //companies.index
// Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions'); //transactions.index




