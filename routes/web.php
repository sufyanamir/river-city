<?php

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


Route::get('/', [UserController::class, 'index']);
Route::post('/', [UserController::class, 'login']);
Route::match(['get', 'post'], '/logout', [UserController::class, 'logout']);

Route::middleware('customauth')->group(function () {

    Route::post('/addUserRole',  [UserController::class, 'addUserRole']);
    Route::get('/userRole', [UserController::class, 'getUserRole']);
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::get('/addUser', [UserController::class, 'addUsers']);
    Route::match(['get', 'post'], '/delete/userRole/{id}', [UserController::class, 'deleteUserRole']);
    Route::get('/customers', function () {
        return view('customers');
    });
    // Route::get('/users', function () {
    //     return view('users');
    // });
    // Route::get('/userRole', function () {
    //     return view('user_roles');
    // });
    Route::get('/crew', function () {
        return view('crew');
    });
    Route::get('/estimates', function () {
        return view('estimates');
    });
    Route::get('/estimates/new', function () {
        return view('newEstimates');
    });
    Route::get('/add-estimate', function () {
        return view('addEstimate');
    });
    Route::get('/items', function () {
        return view('items');
    });
    Route::get('/group', function () {
        return view('group');
    });
    Route::get('/emails', function () {
        return view('email-templates');
    });
    Route::get('/campaign', function () {
        return view('campaign');
    });
    Route::get('/payment-template', function () {
        return view('paymentTemplate');
    });
    Route::get('/reports', function () {
        return view('reports');
    });
    Route::get('/jobs', function () {
        return view('jobs');
    });
    Route::get('/crewCalendar', function () {
        return view('crewCalendar');
    });
    Route::get('/feedGallery', function () {
        return view('feedGallery');
    });
    Route::get('/editQoutation', function () {
        return view('editQoutation');
    });
    Route::get('/manageGallery', function () {
        return view('viewGallery');
    });
    Route::get('/calendar', function () {
        return view('calendar');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get('//addEmail', function () {
        return view('addEmail');
    });
    Route::get('/settings', function () {
        return view('settings');
    });
    Route::get('/help', function () {
        return view('help');
    });
    Route::get('/notifications', function () {
        return view('notifications');
    });
    Route::get('/forgotPassword', function () {
        return view('forgotPassword');
    });
    Route::get('/privileges', function () {
        return view('privileges');
    });
    Route::get('/test', function () {
        return view('test');
    });
});
