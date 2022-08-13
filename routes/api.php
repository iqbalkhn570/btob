<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\BussinessController;
use App\Http\Controllers\Api\OddsSettingController;
use App\Http\Controllers\Api\SwitchoffonController;
use App\Http\Controllers\Api\DateController;
use App\Http\Controllers\Api\LotteryController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return $request->user();
//});

//...


//...
Route::post('register', [AuthController::class, "register"]);
Route::post('login', [AuthController::class, "login"]);
Route::post('login', [AuthController::class, "login"]);
Route::post('admin/login', [AuthController::class, "login"]);


Route::group(["middleware" => ["auth:api"]], function(){

    Route::get("profile", [AuthController::class, "profile"]);
    Route::post("logout", [AuthController::class, "logout"]);
});



Route::middleware('auth:api')->group( function () {
    
});
Route::get("dates", [DateController::class, "index"]);
Route::resource('brands', BrandController::class);
Route::resource('bussinesses', BussinessController::class);
Route::get("switchoffon", [SwitchoffonController::class, "index"]);

Route::get("odds-settings", [OddsSettingController::class, "index"]);
Route::get("odds-settings/rate-setting-detail/{company_id}", [OddsSettingController::class, "rateSettingDetail"]);
Route::get("odds-settings/commission-setting-detail/{company_id}", [OddsSettingController::class, "commissionSettingDetail"]);
Route::get("odds-settings/popular-number-setting", [OddsSettingController::class, "popularNumberList"]);

Route::post("lottery-store", [LotteryController::class, "store"]);
Route::get("lottery-show/{customer_id}", [LotteryController::class, "show"]);
Route::get("lottery-filter/{customer_id}", [LotteryController::class, "filter"]);
Route::get("lottery-delete/{id}", [LotteryController::class, "destroy"]);
Route::get("lottery-slave-list", [LotteryController::class, "lotterySlaveList"]);
