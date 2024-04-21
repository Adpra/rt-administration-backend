<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\v1\BillingController;
use App\Http\Controllers\API\v1\EnumController;
use App\Http\Controllers\API\v1\HouseController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\HouseHolderController;
use App\Http\Controllers\API\v1\ReportFinancialDetailController;
use App\Http\Controllers\API\v1\ReportFinancialSummaryController;
use App\Http\Controllers\API\v1\TransactionHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::name('v1.')
    ->prefix('v1')
    ->group(
        function () {

            Route::post('register', [AuthController::class, 'register']);
            Route::post('login', [AuthController::class, 'login']);
        }
    );

Route::name('v1.')
    ->prefix('v1')
    ->middleware('auth:api')
    ->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);

        Route::apiResource('users', UserController::class);
        Route::apiResource('houses', HouseController::class);
        Route::apiResource('householders', HouseHolderController::class);
        Route::apiResource('billings', BillingController::class);
        Route::apiResource('transaction-histories', TransactionHistoryController::class);

        Route::apiResource('financial-report-detail', ReportFinancialDetailController::class);
        Route::apiResource('financial-report-summaries', ReportFinancialSummaryController::class);
        Route::apiResource('enums', EnumController::class);


    });
