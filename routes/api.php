<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('parse', [App\Http\Controllers\DowloundFileController::class, 'index'])->name('parse');
Route::get('getbyzip/{zipcode}', [App\Http\Controllers\UszipsController::class, 'getByZip'])->name('getbyzip');
Route::get('getbycity/{cityName}', [App\Http\Controllers\UszipsController::class, 'getByCity'])
    ->name('getbycity')->where('cityName', '[a-z]{2}');
