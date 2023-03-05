<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::group(["middleware"=>['web']],function (){
//     Route::get('dashboard',[UserController::class,'dashboard']);
// });

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[UserController::class,'dashboard']);
});

Route::get('login',[UserController::class,'login'])->middleware('authlogin');

Route::get('register',[UserController::class,'register']);
Route::post('register-user',[UserController::class,'register_user']);


Route::post('login-user',[UserController::class,'login_user']);
Route::get('logout',[UserController::class,'logout']);


Route::post('addtasks',[UserController::class,'addtasks']);
Route::get('edit-tasks/{id}',[UserController::class,'edit']);

Route::post('updatetask',[UserController::class,'update']);