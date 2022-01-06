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
    Route::get('/admin/conditions', 'App\Http\Controllers\AdminPanelController@conditions')->name('conditions');
    Route::get('/admin/conditions/create', 'App\Http\Controllers\AdminPanelController@conditions_create')->name('conditions-create');
    Route::post('/admin/conditions/save', 'App\Http\Controllers\AdminPanelController@conditions_save')->name('conditions-save');

    Route::get('/admin/conditions/simulation/edit/{id}', 'App\Http\Controllers\AdminPanelController@conditions_simulation_edit')->name('conditions-edit-simulation');
    Route::post('/admin/conditions/simulation/update', 'App\Http\Controllers\AdminPanelController@conditions_simulation_update')->name('conditions-simulation-update');

    Route::get('/admin/simulations', 'App\Http\Controllers\AdminPanelController@simulations')->name('admin-simulations');
    Route::post('/admin/simulation/accept-offer', 'App\Http\Controllers\AdminPanelController@simulation_accept_offer')->name('simulation-accept-offer');
    Route::post('/admin/simulation/decline-offer', 'App\Http\Controllers\AdminPanelController@simulation_decline_offer')->name('simulation-decline-offer');
});