<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('vaccinations',[VaccinationController::class, 'index']);
Route::get('vaccination/{id}',[VaccinationController::class, 'findById']);
Route::get('vaccination/search/{searchTerm}',[VaccinationController::class, 'findBySearchTerm']);

Route::post('auth/login',[\App\Http\Controllers\AuthController::class,'login']);

Route::get('user/{id}',[UserController::class,'userById']);

Route::group(['middleware'=>['api','auth.jwt']],function () {
    Route::post('vaccination/new', [VaccinationController::class, 'save']);
    Route::put('vaccination/update/{id}', [VaccinationController::class, 'update']);
    Route::delete('vaccination/delete/{id}', [VaccinationController::class, 'delete']);
    Route::post('auth/logout',[\App\Http\Controllers\AuthController::class,'logout']);
    Route::put('user/update/{id}',[UserController::class,'updateUser']);
});
