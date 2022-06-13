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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/', 'Web\HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'Web\DashboardController@index_dashboard');
    Route::get('/dashboard/{id_kas}', 'Web\DashboardController@show_dashboard')->name('show_dashboard');
});
