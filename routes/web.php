<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', 'App\Http\Controllers\AuthController@dashboard'); 
Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('custom-login', 'App\Http\Controllers\AuthController@customLogin')->name('login.custom'); 
Route::get('register', 'App\Http\Controllers\AuthController@registration')->name('register-user');
Route::post('custom-registration', 'App\Http\Controllers\AuthController@customRegistration')->name('register.custom'); 
Route::get('signout', 'App\Http\Controllers\AuthController@signOut')->name('signout');




Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/user-resources', 'App\Http\Controllers\SimulationController@resorces')->name('user-resources');
    Route::get('/user-simulations', 'App\Http\Controllers\SimulationController@simulations')->name('user-simulations');
});


Route::group(['middleware' => ['admin']], function () {
    Route::get('admin-view', 'App\Http\Controllers\AdminPanelController@index')->name('admin-view');
    Route::get('/admin-users', 'App\Http\Controllers\AdminPanelController@users')->name('admin-users');
    Route::post('/admin-change-status', 'App\Http\Controllers\AdminPanelController@change_status')->name('admin-change-status');
    
});