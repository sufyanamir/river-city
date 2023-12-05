<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ItemsController;
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
    Route::get('/users', [UserController::class, 'getUsersWithRoles']);
    Route::post('/addUser', [UserController::class, 'addUsers']);
    Route::match(['get', 'post'], '/delete/user/{id}', [UserController::class, 'deleteUser']);
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
    Route::get('/crew', [UserController::class, 'getDepartementOnCrew']);
    Route::post('/addCrew', [UserController::class, 'addCrew']);
    Route::match(['get', 'post'], '/delete/crew/{id}', [UserController::class, 'deleteCrew']);
    // Route::get('/crew', function () {
    //     return view('crew');
    // });
    Route::get('/estimates', function () {
        return view('estimates');
    });
    Route::get('/estimates/new', function () {
        return view('newEstimates');
    });
    Route::get('/add-estimate', function () {
        return view('addEstimate');
    });
    Route::get('/items', [ItemsController::class, 'getItems']);
    Route::post('/addItem', [ItemsController::class, 'addItem']);
    Route::match(['get', 'post'], '/delete/item/{id}', [ItemsController::class, 'deleteItem']);
    // Route::get('/group', function () {
    //     return view('group');
    // });
    Route::get('/group',[ItemsController::class, 'getGroupsWithItems']);
    Route::post('/addGroup', [GroupController::class], 'addGroup');
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
    Route::post('/addEmail', [EmailController::class, 'addMailTemplate']);
    Route::get('/emails', [EmailController::class, 'getEmails']);
    Route::match(['get', 'post'], '/delete/email/{id}', [EmailController::class, 'deleteEmail']);
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
