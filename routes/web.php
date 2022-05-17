<?php

use Illuminate\Support\Facades\Auth;
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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();
Route::group(['middleware' => 'web'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/reserva/{id}', 'App\Http\Controllers\ProdutosController@reserva')->name('reserva')->middleware('auth');
    Route::get('/cancela/{id}', 'App\Http\Controllers\ProdutosController@cancela')->name('cancela')->middleware('auth');
    Route::post('/email', 'App\Http\Controllers\ProdutosController@email')->name('email')->middleware('auth');
    Route::resource('/produtos', 'App\Http\Controllers\ProdutosController')->middleware('auth');
});

