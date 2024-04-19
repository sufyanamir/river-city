<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EstimageImagesController;
use App\Http\Controllers\EstimateChatController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ItemTemplatesController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserToDoController;
use App\Http\Controllers\BotManController;
use App\Models\Estimate;
use App\Models\EstimateChat;
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

    Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);

    Route::post('/sendInvoiceToQB', [EstimateController::class, 'sendInvoiceToQB']);

    Route::post('/addUserToDo', [UserToDoController::class, 'addUserToDo']);
    Route::post('/deleteUserToDo/{id}', [UserToDoController::class, 'deleteUserToDo']);
    Route::post('/completeUserToDo/{id}', [UserToDoController::class, 'completeUserToDo']);

    Route::post('/addUserRole',  [UserController::class, 'addUserRole']);
    Route::get('/userRole', [UserController::class, 'getUserRole']);
    Route::get('/users', [UserController::class, 'getUsersWithRoles']);
    Route::post('/addUser', [UserController::class, 'addUsers']);
    Route::post('/editUser', [UserController::class, 'editUser']);
    Route::match(['get', 'post'], '/delete/user/{id}', [UserController::class, 'deleteUser']);
    Route::match(['get', 'post'], '/delete/userRole/{id}', [UserController::class, 'deleteUserRole']);
    
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/getCustomerToEdit{id}', [CustomerController::class, 'getCustomerToEdit']);
    Route::post('/updateCustomer', [CustomerController::class, 'updateCustomer']);
    // Route::get('/users', function () {
    //     return view('users');
    // });
    // Route::get('/userRole', function () {
    //     return view('user_roles');
    // });
    Route::get('/crew', [UserController::class, 'getDepartementOnCrew']);
    Route::post('/addCrew', [UserController::class, 'addCrew']);
    Route::get('/getCrewOnAction/{id}', [UserController::class, 'getCrewOnAction']);
    Route::post('/updateCrew', [UserController::class, 'updateCrew']);
    Route::match(['get', 'post'], '/delete/crew/{id}', [UserController::class, 'deleteCrew']);
    // Route::get('/crew', function () {
    //     return view('crew');
    // });
    Route::match(['get', 'post'], '/getEstimateWithImages', [EstimateController::class, 'getEstimateWithImages']);
    Route::get('/estimates/{type?}', [EstimateController::class, 'index'])->name('estimates');
    Route::post('/cancelEstimate/{id}', [EstimateController::class, 'cancelEstimate']);
    Route::post('/addEstimate', [EstimateController::class, 'addCustomerAndEstimate']);
    Route::get('/viewEstimate/{id}', [EstimateController::class, 'viewEstimate']);
    Route::post('/additionalContact', [EstimateController::class,  'additionalContacts']);
    Route::match(['post', 'get'], '/delete/additionalContact/{id}', [EstimateController::class, 'deleteAdditionalContact']);
    Route::post('/addEstimateItems', [EstimateController::class, 'estimateItems']);
    Route::get('/getEstimateItem{id}', [EstimateController::class, 'getEstimateItem']);
    Route::post('/addItemInEstimateAndItems', [EstimateController::class, 'addItemInEstimateAndItems']);
    Route::post('/addEstimateNote', [EstimateController::class, 'addEstimateNote']);
    Route::post('/editEstimateNote', [EstimateController::class, 'editEstimateNote']);
    Route::match(['post', 'get'], '/deleteEstimateNote{id}', [EstimateController::class, 'deleteEstimateNote']);
    Route::match(['get', 'post'], '/getemailDetails/{id}', [EstimateController::class, 'getEmailDetails']);
    Route::post('/sendEmail', [EstimateController::class, 'sendEmail']);
    Route::post('/completeEstimate', [EstimateController::class, 'completeEstimate']);
    Route::post('/scheduleEstimate', [EstimateController::class, 'scheduleEstimate']);
    Route::post('/setScheduleWork', [EstimateController::class, 'setScheduleWork']);
    Route::post('/updateScheuleWork', [EstimateController::class, 'updateScheuleWork']);
    Route::post('/addEstimateImage', [EstimageImagesController::class, 'uploadImage']);
    Route::post('/completeWorkAndAssignInvoice', [EstimateController::class, 'completeWorkAndAssignInvoice']);
    Route::post('/completeInvoiceAndAssignPayment', [EstimateController::class, 'completeInvoiceAndAssignPayment']);
    Route::post('/addPayment', [EstimateController::class, 'addPayment']);
    Route::post('/completeProject', [EstimateController::class, 'completeProject']);
    Route::post('/addToDos', [EstimateController::class, 'addToDos']);
    Route::post('/addEstimateExpense', [EstimateController::class, 'addEstimateExpense']);
    Route::post('/addEstimateFile', [EstimateController::class, 'uploadFile']);
    ROute::match(['get', 'post'], '/deleteFile{id}', [EstimateController::class, 'deleteFile']);
    Route::get('/getCustomerDetails/{id}', [EstimateController::class, 'getCustomerDetails']);
    Route::post('/sendChat', [EstimateChatController::class, 'sendChat']);
    Route::get('/estimates/getChatMessage/{id}', [EstimateChatController::class, 'getChatMessage']);
    Route::get('/getItemData/{id}', [ItemsController::class, 'getItemData']);
    Route::post('/updateEstimateItem', [EstimateController::class, 'updateEstimateItem']);
    Route::post('/updateAdditionalContact', [EstimateController::class, 'updateAdditionalContact']);
    Route::get('/getEstimateActivity/{id}', [EstimateController::class, 'getEstimateActivity']);
    Route::get('/getItemTemplateItems/{id}', [EstimateController::class, 'getItemTemplateItems']);
    Route::post('/addEstimateItemTemplate', [EstimateController::class, 'addEstimateItemTemplate']);
    Route::post('/deleteEstimateTemplate/{id}', [EstimateController::class, 'deleteEstimateTemplate']);
    Route::get('/getEstItemTemplateToEdit/{id}', [EstimateController::class, 'getEstItemTemplateToEdit']);
    Route::post('/updateEstimateItemTemplate', [EstimateController::class, 'updateEstimateItemTemplate']);
    Route::get('/getEstimateTemplateItem{id}', [EstimateController::class, 'getEstimateTemplateItem']);
    Route::post('/updateEstimateTemplateItem', [EstimateController::class, 'updateEstimateTemplateItem']);
    Route::post('/deleteEstimateItem/{id}', [EstimateController::class, 'deleteEstimateItem']);
    Route::post('/includeexcludeEstimateItem', [EstimateController::class, 'includeexcludeEstimateItem']);

    Route::get('/viewEstimateMaterials/{id}', [EstimateController::class, 'viewEstimateMaterials']);

    Route::get('/getExpenseDataToEdit{id}', [EstimateController::class, 'getExpenseDataToEdit']);
    ROute::post('/updateEstimateExpense', [EstimateController::class, 'updateEstimateExpense']);
    Route::match(['get', 'post'], '/deleteEstimateExpense/{id}', [EstimateController::class, 'deleteEstimateExpense']);

    Route::post('/completeToDo{id}', [EstimateController::class, 'completeToDo']);
    Route::match(['get', 'post'], '/deleteToDo{id}', [EstimateController::class, 'deleteToDo']);

    Route::post('/addItemTemplate', [ItemTemplatesController::class, 'addItemTemplate']);
    Route::get('/itemTemplates', [ItemTemplatesController::class, 'index']);
    Route::get('/getTemplateToEdit/{id}', [ItemTemplatesController::class, 'getTemplateToEdit']);
    Route::post('/updateItemTemplate', [ItemTemplatesController::class, 'updateItemTemplate']);
    Route::match(['post', 'get'], '/deleteTemplate/{id}', [ItemTemplatesController::class, 'deleteTemplate']);
    Route::get('/items/{type?}', [ItemsController::class, 'getItems'])->name('items');
    Route::post('/addItem', [ItemsController::class, 'addItem']);
    Route::get('/getItemToEdit/{id}', [ItemsController::class, 'getItemToEdit']);
    Route::post('/updateItem', [ItemsController::class, 'updateItem']);
    Route::match(['get', 'post'], '/delete/item/{id}', [ItemsController::class, 'deleteItem']);
    // Route::get('/group', function () {
    //     return view('group');
    // });
    Route::get('/group', [GroupController::class, 'getGroups']);
    Route::post('/editGroup', [GroupController::class, 'editGroup']);
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

    Route::get('/reports', [ReportsController::class, 'index']);
    
    ROute::get('/jobs', [EstimateController::class, 'getEstimateOnJobs']);
    // Route::get('/jobs', function () {
    //     return view('jobs');
    // });
    Route::get('/crewCalendar', [EstimateController::class, 'getEstimatesOnCrewCalendar']);
    Route::get('/viewDataOnCrewCalendar{id}', [EstimateController::class, 'viewDataOnCrewCalendar']);
    Route::get('/feedGallery', [EstimateController::class, 'getEstimateWithImages']);
    // Route::get('/feedGallery', function () {
    //     return view('feedGallery');
    // });
    Route::get('/editQoutation', function () {
        return view('editQoutation');
    });
    Route::get('/viewGallery{id}', [EstimageImagesController::class, 'viewGallery']);
    // Route::get('/deleteEstimateImage', [EstimageImagesController::class, 'deleteEstimateImage']);
    Route::match(['post', 'get'], 'deleteEstimateImage{id}', [EstimageImagesController::class, 'deleteEstimateImage']);

    Route::get('/calendar', [EstimateController::class, 'getEstimatesOnCalendar']);
    Route::get('/getEstimateToSetScheduleWork{id}', [EstimateController::class, 'getEstimateToSetScheduleWork']);
    Route::get('/getEstimateToSetSchedule{id}', [EstimateController::class, 'getEstimateToSetSchedule']);
    Route::post('/setScheduleEstimate', [EstimateController::class, 'setScheduleEstimate']);
    // Route::get('/calendar', function () {
    //     return view('calendar');
    // });
    Route::get('/dashboard/{user?}', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // });
    Route::get('//addEmail', function () {
        return view('addEmail');
    });
    Route::post('/addEmail', [EmailController::class, 'addMailTemplate']);
    Route::get('/emails', [EmailController::class, 'getEmails']);
    Route::match(['get', 'post'], '/delete/email/{id}', [EmailController::class, 'deleteEmail']);

    Route::get('/settings', [UserController::class, 'getUserOnSettings']);
    Route::post('/updateSettings', [UserController::class, 'updateSettings']);
    Route::post('/updateCompany', [UserController::class, 'updateCompany']);
    
    Route::get('/getEmailToEdit/{id}', [EmailController::class, 'getEmailToEdit']);
    Route::post('/updateEmail', [EmailController::class, 'updateEmail']);
    Route::get('/help', function () {
        return view('help');
    });
    Route::get('/notifications', [NotificationsController::class, 'index']);
    Route::post('/markNotifications', [NotificationsController::class, 'markNotifications']);
    Route::get('/privileges/{id}', [UserController::class, 'getUserOnPrivileges']);
    Route::post('/addUserPrivileges/{id}', [UserController::class, 'addUserPrivileges']);
    Route::get('/getprivileges/{id}', [UserController::class, 'getUserPrivileges']);
    Route::get('/mail', function () {
        return view('emails.proposal_accepted_mail');
    });
});
Route::get('/forgotPassword', function () {
    return view('forgotPassword');
});
Route::post('/forgotPasswordMail', [UserController::class, 'forgotPasswordMail']);
Route::get('/resetPassword/{id}', [UserController::class, 'resetPassword']);
Route::post('/updatePassword', [UserController::class, 'updatePassword']);