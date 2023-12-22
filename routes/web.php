<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EstimageImagesController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UserController;
use App\Models\Estimate;
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
Route::get('/viewProposal/{id}', [EstimateController::class, 'viewProposal']);
Route::post('/acceptProposal/{id}', [EstimateController::class, 'acceptProposal']);

Route::middleware('customauth')->group(function () {

    Route::post('/addUserRole',  [UserController::class, 'addUserRole']);
    Route::get('/userRole', [UserController::class, 'getUserRole']);
    Route::get('/users', [UserController::class, 'getUsersWithRoles']);
    Route::post('/addUser', [UserController::class, 'addUsers']);
    Route::match(['get', 'post'], '/delete/user/{id}', [UserController::class, 'deleteUser']);
    Route::match(['get', 'post'], '/delete/userRole/{id}', [UserController::class, 'deleteUserRole']);
    Route::get('/customers', [CustomerController::class, 'index']);
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
    Route::match(['get', 'post'], '/getEstimateWithImages', [EstimateController::class, 'getEstimateWithImages']);
    Route::get('/estimates', [EstimateController::class, 'index']);
    Route::post('/addEstimate', [EstimateController::class, 'addCustomerAndEstimate']);
    Route::get('/viewEstimate/{id}', [EstimateController::class, 'viewEstimate']);
    Route::post('/additionalContact', [EstimateController::class,  'additionalContacts']);
    Route::match(['post', 'get'], '/delete/additionalContact/{id}', [EstimateController::class, 'deleteAdditionalContact']);
    Route::post('/addEstimateItems', [EstimateController::class, 'estimateItems']);
    Route::post('/addEstimateNote', [EstimateController::class, 'addEstimateNote']);
    Route::match(['get', 'post'], '/getemailDetails/{id}', [EstimateController::class, 'getEmailDetails']);
    Route::post('/sendEmail', [EstimateController::class, 'sendEmail']);
    Route::post('/completeEstimate', [EstimateController::class, 'completeEstimate']);
    Route::post('/scheduleEstimate', [EstimateController::class, 'scheduleEstimate']);
    Route::post('/setSchedule', [EstimateController::class, 'setSchedule']);
    Route::post('/addEstimateImage', [EstimageImagesController::class, 'addEstimateImage']);
    Route::post('/completeWorkAndAssignInvoice', [EstimateController::class, 'completeWorkAndAssignInvoice']);
    Route::post('/completeInvoiceAndAssignPayment', [EstimateController::class, 'completeInvoiceAndAssignPayment']);
    Route::post('/addPayment', [EstimateController::class, 'addPayment']);
    Route::post('/completeProject', [EstimateController::class, 'completeProject']);
    Route::post('/addToDos', [EstimateController::class, 'addToDos']);
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
    Route::post('/addGroup', [GroupController::class, 'addGroup']);
    Route::match(['post', 'get'], '/delete/group/{id}', [GroupController::class, 'deleteGroup']);
    Route::get('/emails', function () {
        return view('email-templates');
    });
    Route::get('/campaign', function () {
        return view('campaign');
    });
    Route::post('/sendProposal', [EstimateController::class, 'sendProposal']);
    Route::get('/makeProposal/{id}', [EstimateController::class, 'makeProposal']);
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
    Route::get('/feedGallery', [EstimateController::class, 'getEstimateWithImages']);
    // Route::get('/feedGallery', function () {
    //     return view('feedGallery');
    // });
    Route::get('/editQoutation', function () {
        return view('editQoutation');
    });
    Route::get('/manageGallery', function () {
        return view('viewGallery');
    });

    Route::get('/calendar', [EstimateController::class, 'getEstimatesOnCalendar']);
    // Route::get('/calendar', function () {
    //     return view('calendar');
    // });
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
    Route::get('/privileges/{id}', [UserController::class, 'getUserOnPrivileges']);
    Route::post('/addUserPrivileges/{id}', [UserController::class, 'addUserPrivileges']);
    Route::get('/getprivileges/{id}', [UserController::class, 'getUserPrivileges']);
    Route::get('/test', function () {
        return view('test');
    });
});
