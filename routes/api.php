<?php

use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->post('/todo/add',[TaskController::class,'add']);
// Route::middleware('auth:sanctum')->get('/todo/showtask',[TaskController::class,'showtask']);
Route::middleware('auth:sanctum')->put('todo/status/{id}',[TaskController::class,'status']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/todo/showtask/{userid}',[TaskController::class,'showtask']);

