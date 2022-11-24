<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', function(){
    return view('welcome');
});
    
Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::post('/login/auth', 'authentication')->name('auth');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function(){
    Route::resource('/companies', CompanyController::class);
});

Route::middleware('auth')->group(function(){
    Route::middleware('checkUser:admin')->resource('/user', UserController::class);
});

Route::middleware('auth')->group(function(){
    Route::resource('/employee', EmployeeController::class);
});