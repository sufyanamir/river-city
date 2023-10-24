<?php

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
    return view('dashboard');
});
Route::get('/customers', function () {
    return view('customers');
});
Route::get('/users', function () {
    return view('users');
});
Route::get('/userRole', function () {
    return view('user_roles');
});
Route::get('/login',function(){
    return view('login');
});
Route::get('/forgotPassword',function(){
    return view('forgotPassword');
});
Route::get('/privileges',function(){
    return view('privileges');
});
Route::get('/test',function(){
    return view('test');
});

