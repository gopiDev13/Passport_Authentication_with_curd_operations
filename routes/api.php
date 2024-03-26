<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\EmployeeController;
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
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



Route::middleware('auth:api')->group(function(){

  
    Route::post('/store-department',[DepartmentController::class,'store']);
    Route::get('show-department/{id}',[DepartmentController::class,'show']);
    Route::get('/show-all-departments',[DepartmentController::class,'index']);
    Route::post('/update-department/{id}',[DepartmentController::class,'update']);
    Route::delete('/delete-department/{id}',[DepartmentController::class,'destroy']);
    // Route::get('/logout-user',[DepartmentController::class,'logout']);

    Route::post('/store-designation',[DesignationController::class,'store']);
    Route::get('show-designation/{id}',[DesignationController::class,'show']);
    Route::get('/show-all-designations',[DesignationController::class,'index']);
    Route::post('/update-designation/{id}',[DesignationController::class,'update']);
    Route::delete('/delete-designation/{id}',[DesignationController::class,'destroy']);

    Route::post('/store-employee',[EmployeeController::class,'store']);
    Route::get('/show-employee/{id}',[EmployeeController::class,'show']);
    Route::get('/show-all-employee',[EmployeeController::class,'index']);
    Route::post('/update-employee/{id}',[EmployeeController::class,'update']);
    Route::delete('/delete-employee/{id}',[EmployeeController::class,'destroy']);
});
