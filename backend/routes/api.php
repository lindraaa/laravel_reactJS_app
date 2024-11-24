<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Usercontroller;


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

Route::get("users",[Usercontroller::class,"index"]);
Route::get("data",[DataController::class,"get_data"]);
Route::post("data",[DataController::class,"post_data"]);
Route::put("data/{id}",[DataController::class,"update_data"]);
Route::delete("data/{id}",[DataController::class,"delete_data"]);
Route::get("data/{search}",[DataController::class,"search_data"]);
