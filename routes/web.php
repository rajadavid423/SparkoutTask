<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if (auth()->user()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(static function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('home/total-account-balance', [HomeController::class, 'totalAccountBalance'])->name('totalAccountBalance');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('change-password', [EmployeeController::class, 'changePassword'])->name('change-password');
    Route::post('password-update', [EmployeeController::class, 'passwordUpdate'])->name('password-update');
    Route::post('global-search', [HomeController::class, 'globalSearch'])->name('globalSearch');

    Route::resource('role', RoleController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('product-category', ProductCategoryController::class)->except(['create', 'edit']);
    Route::resource('product', ProductController::class);
});
