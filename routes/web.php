<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[UserController::class,'index'])->name('user.index');
Route::post('/',[UserController::class,'signup'])->name('user.signup');
Route::get('/about',[UserController::class,'about'])->name('user.about');
Route::get('/emailVerify',[UserController::class,'emailVerify'])->name('emailVerify');
Route::post('/login',[UserController::class,'login'])->name('user.login');
Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
Route::get('logout',[UserController::class,'logout'])->name('user.logout');