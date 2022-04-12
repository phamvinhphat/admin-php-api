<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WorkflowController;
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
Route::group(['middleware' => ['api','cors'], 'prefix' => 'auth'],function ($route) {
    Route::post('login',[AccountController::class,'login']);
    Route::post('register',[AccountController::class,'register']);
    Route::post('logout',[AccountController::class,'logout']);
});

// Account
Route::group(['middleware' => ['api','cors'], "prefix"=>"account"],function(){
    Route::get('/getViewUser',[AccountController::class,'getViewUser']);
    Route::get('/getMyInfo',[AccountController::class,'getMyInfo']);
    Route::patch('/updateAccount',[AccountController::class,'updateUser']);
    Route::get('/checkRole/{id}',[AccountController::class,'checkRole']);
    Route::patch('/changeIsAdmin/{id}',[AccountController::class,'changeIsAdmin']);
    Route::get('/findUserById/{id}',[AccountController::class,'findUserById']);
    Route::get('/refresh',[AccountController::class,'refresh']);
    //Route::patch('/changePassword',[AccountController::class,'changePassword']);
});

//role
Route::group(["prefix"=>"role"],function(){
    Route::get('/getAllRole',[RoleController::class,'getAllRole']);
    Route::get('/getMyRole',[RoleController::class,'getMyRole']);
    Route::post('/createRole',[RoleController::class,'createRole']);
    Route::delete('/deleteRole/{id}',[RoleController::class,'deleteRole']);
    Route::patch('/updateRole/{id}',[RoleController::class,'updateRole']);
    Route::get('/listAdmin',[RoleController::class,'listAdmin']);
    Route::get('/listUser',[RoleController::class,'listUser']);
    Route::get('/countListAdmin',[RoleController::class,'countListAdmin']);
    Route::get('/countListUser',[RoleController::class,'countListUser']);
});

// permission
Route::group(["prefix"=>"permission"],function(){
    Route::get('/getViewPermission',[PermissionController::class,'getAllPermission']);
    Route::post('/createPermission',[PermissionController::class,'createPermission']);
    Route::get('/getPermission/{id}',[PermissionController::class,'findPermissionById']);
    Route::patch('/updatePermission/{id}',[PermissionController::class,'updatePermissionById']);
    Route::delete('/deletePermission/{id}',[PermissionController::class,'deletePermissionById']);
    Route::get('/getPermissionByName',[PermissionController::class,'findPermissionByName']);
    Route::get('/getPermissionById/{id}',[PermissionController::class,'finPermissionById']);
});

// grant permission
Route::group(["prefix"=>"rolePermission"],function (){
    Route::get('/getAllGrantPermission',[RolePermissionController::class,'getAllGrantPermission']);
    Route::post('/createGrantPermission',[RolePermissionController::class,'createGrantPermission']);
    Route::get('/findGrantPermissionById',[RolePermissionController::class,'findGrantPermissionById']);
    Route::delete('/deleteGrantPermission',[RolePermissionController::class,'deleteGrantPermission']);
    Route::get('/findGrantPermission',[RolePermissionController::class,'findGrantPermissionByIdRole']);
});

// Status
Route::group(["prefix"=>"status"],function (){
    Route::post('/createStatus',[StatusController::class,'createdStatus']);
    Route::get('/findStatusById/{id}',[StatusController::class,'findStatusById']);
    Route::get('/getAllStatus', [StatusController::class, 'getAllStatus']);
    Route::get('/checkStatus/{id}',[StatusController::class,'checkStatus']);
    Route::delete('/deleteStatus/{id}',[StatusController::class,'deleteStatus']);
    Route::patch('/updateStatus/{id}',[StatusController::class,'updateStatus']);
    Route::get('/findStatusByMyId',[StatusController::class,'findStatusByMyId']);
});

// Document
Route::group(["prefix"=>"document"],function (){
   Route::post('/createDocument',[DocumentController::class, 'createDocument']);
   Route::get('/getAllDocument',[DocumentController::class,'getAllDocument']);
   Route::get('/findDocumentById/{id}',[DocumentController::class,'findDocumentById']);
   Route::delete('/deleteDocumentById/{id}',[DocumentController::class,'deleteDocumentById']);
   Route::get('/findDocByIdUser/{id}',[DocumentController::class,'findDocByIdUser']);
   Route::get('/findDocByMyId',[DocumentController::class,'findDocByMyId']);
   Route::patch('/updateDocument/{id}',[DocumentController::class,'updateDocByID']);
   Route::get('/findStatusByDoc/{id}',[DocumentController::class,'findStatusByIdDoc']);
   Route::get('/checkRole',[DocumentController::class,'checkRole']);
//   Route::get('/getDocStatus',[DocumentController::class,'getDocStatus']);
//   Route::get('/getDoneDocStatus',[DocumentController::class,'getDoneDocStatus']);
   Route::get('/getAllDocumentAndStatus',[DocumentController::class,'getAllDocumentAndStatus']);
   Route::get('/returnDataDocByStatus/{id}',[DocumentController::class,'returnDataDocByStatus']);
});

//workflow
Route::group(["prefix"=>"workflow"],function (){
    // create post in create workflow
    Route::post('/createWorkflow',[WorkflowController::class,'createdWorkflow']);
    Route::get('/getAllWorkflow',[WorkflowController::class,'getAllWorkflow']);
    Route::get('/findWorkflowById/{id}',[WorkflowController::class,'findWorkflowById']);
    Route::delete('/deleteWorkflow/{id}',[WorkflowController::class,'deleteWorkflow']);
    Route::patch('/updateWorkflow/{id}',[WorkflowController::class,'updateWorkflow']);
});

//post
Route::group(["prefix"=>"post"],function (){
    Route::get('/getAllPost',[PostController::class,'getViewPost']);
    Route::post('/createPost/{id}',[PostController::class,'createPost']);
});
