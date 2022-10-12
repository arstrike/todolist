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


Route::get('task/list', [App\Http\Controllers\Api\TaskController::class, 'index']);
Route::post('task/store', [App\Http\Controllers\Api\TaskController::class, 'store']);
Route::put('task/update/{task}', [App\Http\Controllers\Api\TaskController::class, 'update']);
Route::put('task/complete/{task}', [App\Http\Controllers\Api\TaskController::class, 'complete_task']);
Route::delete('task/delete/{task}', [App\Http\Controllers\Api\TaskController::class, 'delete']);