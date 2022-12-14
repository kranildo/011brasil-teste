<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//UserController
Route::middleware('auth:api')->post('/user/create', [UserController::class, 'create']);
Route::middleware('auth:api')->put('/user/edit/{id}', [UserController::class, 'edit']);
Route::middleware('auth:api')->put('/user/assignrole/{id}', [UserController::class, 'assignRole']);