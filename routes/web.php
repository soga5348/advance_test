<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index',[ContactController::class ,'index'])->name('index');
Route::post('/store',[ContactController::class ,'store'])->name('store');
Route::get('/confirm',[ContactController::class ,'confirm'])->name('confirm');
Route::get('/thanks',[ContactController::class ,'thanks'])->name('thanks');
Route::get('/back',[ContactController::class ,'back'])->name('back');
Route::get('/find',[ContactController::class ,'find'])->name('find');
Route::get('/message',[ContactController::class ,'message'])->name('message');
Route::delete('/delete/{contact}', [ContactController::class, 'destroy'])->name('delete');
Route::get('/address/{postalCode}', [ContactController::class, 'address'])->name('address');



