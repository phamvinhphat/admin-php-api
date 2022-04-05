<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;

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

//Authentication
Route::group(['middleware' => 'api', 'prefix' => 'auth'],function ($route) {
    Route::post('login',[AccountController::class,'login']);
    Route::post('register',[AccountController::class,'register']);
    Route::post('logout',[AccountController::class,'logout']);
});

// Account
Route::group(["prefix"=>"account"],function(){
    Route::get('/getViewUser',[AccountController::class,'getViewUser']);
    Route::get('/getUser/{userID}',[AccountController::class,'getUserById']);
    Route::patch('/updateAccount/{id}',[AccountController::class,'updateRoleById']);
    Route::get('/checkRole/{id}',[AccountController::class,'checkRole']);
    Route::patch('/changeIsAdmin/{id}',[AccountController::class,'changeIsAdmin']);
});

//role
Route::group(["prefix"=>"role"],function(){
    Route::get('/getAllRole',[RoleController::class,'getAllRole']);
});

// permission
Route::group(["prefix"=>"permission"],function(){
    Route::get('/getViewPermission',[PermissionController::class,'getAllPermission']);
    Route::post('/createPermission',[PermissionController::class,'createPermission']);
    Route::get('/getPermission/{id}',[PermissionController::class,'findPermissionById']);
    Route::patch('/updatePermission/{id}',[PermissionController::class,'updatePermissionById']);
    Route::delete('/deletePermission/{id}',[PermissionController::class,'deletePermissionById']);
    Route::get('/getPermissionByTitle/{permission_title}',[PermissionController::class,'findPermissionByTitle']);
});

// grant permission
Route::group(["prefix"=>"rolePermission"],function (){
    Route::get('/getAllGrantPermission',[RolePermissionController::class,'getAllGrantPermission']);
    Route::post('/createGrantPermission',[RolePermissionController::class,'createGrantPermission']);
    Route::get('/findGrantPermissionById',[RolePermissionController::class,'findGrantPermissionById']);
    Route::delete('/deleteGrantPermission',[RolePermissionController::class,'deleteGrantPermission']);
    Route::get('/findGrantPermission',[RolePermissionController::class,'findGrantPermissionByIdRole']);
});
