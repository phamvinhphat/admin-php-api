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
Route::group(["prefix"=>"account"],function(){
    Route::get('/getViewUser',[AccountController::class,'getViewUser']);
    Route::get('/getUserById/{userID}',[AccountController::class,'getUserById']);
});

//role
Route::group(["prefix"=>"role"],function(){
    Route::get('/getAllRole',[RoleController::class,'getAllRole']);
});

// permission
Route::group(["prefix"=>"permission"],function(){
    Route::get('/getViewPermission',[PermissionController::class,'getAllPermission']);
});
