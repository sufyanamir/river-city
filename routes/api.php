<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function(){
   Route::get('/getUserDetails', [ApiController::class, 'getUserDetails']); //for user details
   Route::get('/getDashboard',[ApiController::class, 'getDashboard']); //for Dashboard
   Route::get('/getCustomer', [ApiController::class, 'getCustomer']); //for getCustomer
   Route::post('/updateCustomer', [ApiController::class, 'updateCustomer']); //updateCustomer
   Route::delete('/deleteCustomer/{id}', [ApiController::class, 'deleteCustomer']); //for deleteCustomer
   Route::put('/editCustomer/{id}',[ApiController::class, 'editCustomer']); //for editCustomer

//    Estimate RUL
   Route::get('/getEstimate',[ApiController::class, 'getEstimate']);//for Estimate
   Route::post('/CustomerAndEstimateAdd', [ApiController::class, 'CustomerAndEstimateAdd']); //Add estimate
   Route::get('/getEstimateDetails/{id}', [ApiController::class, 'getEstimateDetails']);//estimate details
   Route::get('/getEstimateItems/{id}', [ApiController::class, 'getEstimateItems']);


   Route::get('/getEstimateActivity/{id}', [ApiController::class, 'getEstimateActivity']);
   Route::get('/viewEstimateMaterials/{id}', [ApiController::class, 'viewEstimateMaterials']);

    Route::post('/cancelEstimate/{id}', [ApiController::class, 'cancelEstimate']);
   Route::delete('/deleteEstimate/{id}', [ApiController::class, 'deleteEstimate']);//delete estimate
   Route::post('/updateEstimateDetail',[ApiController::class, 'updateEstimateDetail']);//updateEstimateDetail
//    Estimate Contact Route
   Route::post('/addContacts', [ApiController::class, 'addContacts']); //addContacts
   Route::post('/updateContact', [ApiController::class, 'updateContact']); //updateContact
   Route::delete('/deleteContact/{id}', [ApiController::class, 'deleteContact']);//deleteContact
//    Estimate Items Route
   Route::post('/addEstimateItems', [ApiController::class, 'addEstimateItems']);//addEstimateItems
   Route::get('/getEstimateItem/{id}',[ApiController::class, 'getEstimateItem']);//getEstimateItem
   Route::post('/updateEstimateItem', [ApiController::class, 'updateEstimateItem']);//updateEstimateItem
   Route::delete('/deleteEstimateItem/{id}', [ApiController::class, 'deleteEstimateItem']); //deleteEstimateItem
   Route::post('/editGroup', [ApiController::class, 'editGroup']);//editGroup
   Route::post('/deleteEstimateGroupItems', [ApiController::class, 'deleteEstimateGroupItems']);//deleteEstimateGroupItems
    Route::post('/addEstimateItemTemplate', [ApiController::class, 'addEstimateItemTemplate']);
   //Add Estimate File
   Route::post('/addEstimateFile', [ApiController::class, 'addEstimateFile']);//addEstimateFile
   Route::delete('/deleteFile/{id}', [ApiController::class, 'deleteFile']); //deleteFile
   Route::get('/viewGallery/{id}', [ApiController::class,'viewGallery']);//EstimateviewGallery

   Route::post('/sendProposal', [ApiController::class, 'sendProposal']); //sendProposal
   Route::get('/makeProposal/{id}', [ApiController::class, 'makeProposal']);//makeProposal
   Route::get('/viewProposal', [ApiController::class, 'viewProposal']); //viewProposal

   Route::post('/addEstimateNote', [ApiController::class, 'addEstimateNote']); //addEstimateNote
   Route::post('/editEstimateNote', [ApiController::class, 'editEstimateNote']);//editEstimateNote
   Route::delete('/deleteEstimateNote/{id}', [ApiController::class, 'deleteEstimateNote']);//deleteEstimateNote

    Route::post('/sendEmail', [ApiController::class, 'sendEmail']);
   Route::post('/addPayment', [ApiController::class, 'addPayment']);//addPayment Estimate
   Route::get('/getPayment/{id}', [ApiController::class, 'getPayment']);//getPaymen
   Route::post('/updatePayment', [ApiController::class, 'updatePayment']); //updatePayment
   Route::delete('/deletePayment/{id}', [ApiController::class, 'deletePayment']);//deletePayment
   Route::get('/viewPayment/{id}', [ApiController::class, 'viewPayment']); //viewPayment


   Route::post('/addEstimateExpense', [ApiController::class, 'addEstimateExpense']);//addEstimateExpense
   Route::get('/getExpenseDataToEdit/{id}', [ApiController::class, 'getExpenseDataToEdit']);//getExpenseDataToEdit
   Route::post('/updateEstimateExpense', [ApiController::class, 'updateEstimateExpense']);//updateEstimateExpense
   Route::delete('/deleteEstimateExpense/{id}', [ApiController::class, 'deleteEstimateExpense']);//deleteEstimateExpense

   Route::post('/completeInvoiceAndAssignPayment', [ApiController::class, 'completeInvoiceAndAssignPayment']);//completeInvoiceAndAssignPayment
   Route::get('/getInvoice/{id}', [ApiController::class, 'getInvoice']);//getInvoice
   Route::post('/updateInvoice', [ApiController::class, 'updateInvoice']);//updateInvoice
   Route::delete('/deleteInvoice/{id}', [ApiController::class, 'deleteInvoice']);//deleteInvoice
   Route::get('/viewInvoice/{id}', [ApiController::class, 'viewInvoice']);//viewInvoice
   Route::post('/addToDos', [ApiController::class, 'addToDos']);// addToDos
   Route::post('/completeToDo/{id}', [ApiController::class, 'completeToDo']);//completeToDo
   Route::delete('/deleteToDo/{id}', [ApiController::class, 'deleteToDo']); //deleteToDo

   Route::post('/includeexcludeEstimateItem', [ApiController::class, 'includeexcludeEstimateItem']);
//    Calendar
   Route::get('/getEstimatesOnCalendar/{id?}', [ApiController::class, 'getEstimatesOnCalendar']);//getEstimatesOnCalendar
   Route::get('/getEstimateToSetSchedule/{id}',[ApiController::class,'getEstimateToSetSchedule']);
   Route::post('/addUserToDo', [ApiController::class, 'addUserToDo']);
   Route::delete('/deleteUserToDo/{id}', [ApiController::class, 'deleteUserToDo']);// deleteUserToDo
   Route::get('/deleteUserToDo/{id}', [ApiController::class, 'deleteUserToDo']);
   Route::post('/completeUserToDo/{id}', [ApiController::class, 'completeUserToDo']);//completeUserToDo
   Route::post('/setScheduleEstimate', [ApiController::class, 'setScheduleEstimate']);
    Route::delete('/deleteScheduleEstimate/{id}', [ApiController::class, 'deleteScheduleEstimate']);
    Route::post('/completeEstimate', [ApiController::class, 'completeEstimate']);//completeEstimate
    Route::post('/reassignCompleteEstimate', [ApiController::class, 'reassignCompleteEstimate']);
    Route::post('/scheduleEstimate', [ApiController::class, 'scheduleEstimate']);//accept Work
    Route::post('/setScheduleWork', [ApiController::class, 'setScheduleWork']);//setScheduleWork
    Route::post('/updateScheuleWork', [ApiController::class, 'updateScheuleWork']);//updateScheuleWork
    Route::post('/completeWorkAndAssignInvoice', [ApiController::class, 'completeWorkAndAssignInvoice']); //completeWorkAndAssignInvoice

    // viewGallery
    Route::post('/uploadImage', [ApiController::class, 'uploadImage']);//uploadImage
    Route::delete('/deleteEstimateImage/{id}', [ApiController::class, 'deleteEstimateImage']); //deleteEstimateImage

    // getEstimateOnJobs
    Route::get('/crew/getEstimateOnJobs', [ApiController::class, 'getEstimateOnJobs']);
    Route::get('/crew/getChatMessage/{id}', [ApiController::class, 'getChatMessage']);
    Route::get('/crew/viewEstimateMaterials/{id}', [ApiController::class, 'viewEstimateMaterials']);
    Route::get('/getEstimatesOnCrewCalendar', [ApiController::class, 'getEstimatesOnCrewCalendar']);

    // Settings
    Route::get('/getUserOnSettings', [ApiController::class, 'getUserOnSettings']);
    Route::post('/updateSettings', [ApiController::class, 'updateSettings']);

    // Company Branch
    Route::get('/getBranches', [ApiController::class, 'getBranches']);
    //Owner List
    Route::get('/getUsersList/{key?}', [ApiController::class, 'getUsersList']);

    Route::post('/logout', [ApiController::class, 'logout']);

    Route::get('/getItems', [ApiController::class, 'getItems']);
});




Route::post('/login', [ApiController::class, 'login']);

Route::post('forgotPasswordMail',[ApiController::class, 'forgotPasswordMail']);//forgotPasswordMail
Route::get('/resetPassword/{id}', [ApiController::class, 'resetPassword']);// resetPassword

Route::middleware(['check.api.key'])->group(function(){

    Route::post('/getCustomerDetails', [ApiController::class, 'getCustomerDetails']);
    Route::post('/addCustomerAndEstimate', [ApiController::class, 'addCustomerAndEstimate']);
    // Route::post('/addUserToDo', [ApiController::class, 'addUserToDo']);

});

