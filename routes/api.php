<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PermissionController;

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

// Account
Route::get('/account/getViewUser',[AccountController::class,'getViewUser']);
Route::get('/account/getUserById/{userID}',[AccountController::class,'getUserById']);

//role
Route::get('/role/getAllRole',[RoleController::class,'getAllRole']);

// permission
Route::get('permission/getAllPermission',[PermissionController::class,'getAllPermission']);
