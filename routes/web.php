<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'App\Http\Controllers\PageController@main_page')->name('main-page');

Route::get('dashboard', 'App\Http\Controllers\AuthController@dashboard'); 
Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('custom-login', 'App\Http\Controllers\AuthController@customLogin')->name('login.custom'); 
Route::get('register', 'App\Http\Controllers\AuthController@registration')->name('register-user');
Route::post('custom-registration', 'App\Http\Controllers\AuthController@customRegistration')->name('register.custom'); 
Route::get('signout', 'App\Http\Controllers\AuthController@signOut')->name('signout');




Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/user-computers', 'App\Http\Controllers\SimulationController@computers')->name('user-computers');
    Route::post('/user-computers-buy', 'App\Http\Controllers\SimulationController@computers_buy')->name('user-computers-buy');
    Route::get('/user-resources', 'App\Http\Controllers\SimulationController@resorces')->name('user-resources');
    Route::get('/user-simulations', 'App\Http\Controllers\SimulationController@simulations')->name('user-simulations');
    Route::post('/user-create-offer-simulation', 'App\Http\Controllers\SimulationController@create_offer_simulation')->name('create-offer-simulation');
});


Route::group(['middleware' => ['admin']], function () {
    Route::get('admin-view', 'App\Http\Controllers\AdminPanelController@index')->name('admin-view');
    Route::get('/admin-users', 'App\Http\Controllers\AdminPanelController@users')->name('admin-users');
    Route::post('/admin-change-status', 'App\Http\Controllers\AdminPanelController@change_status')->name('admin-change-status');
    Route::get('/admin/computers', 'App\Http\Controllers\AdminPanelController@computers')->name('computers');
    Route::get('/admin/computer-create', 'App\Http\Controllers\AdminPanelController@computer_create')->name('computer-create');
    Route::post('/admin/computer-save', 'App\Http\Controllers\AdminPanelController@computer_save')->name('computer-save');
    Route::get('/admin/computer-edit/{id}', 'App\Http\Controllers\AdminPanelController@computer_edit')->name('computer-edit');
    Route::post('/admin/computer-update', 'App\Http\Controllers\AdminPanelController@computer_update')->name('computer-update');
    
});