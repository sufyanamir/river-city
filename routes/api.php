<?php

use App\Http\Controllers\api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
   Route::get('/getUserDetails', [ApiController::class, 'getUserDetails']); 
});

Route::post('/login', [ApiController::class, 'login']);

Route::middleware(['check.api.key'])->group(function(){

    Route::post('/getCustomerDetails', [ApiController::class, 'getCustomerDetails']);
    Route::post('/addCustomerAndEstimate', [ApiController::class, 'addCustomerAndEstimate']);
    Route::post('/addUserToDo', [ApiController::class, 'addUserToDo']);

});

