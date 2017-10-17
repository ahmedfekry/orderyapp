<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);


Route::group(['middleware' => 'auth'], function() {
    Route::resource('dashboard', 'DashboardController');
    Route::get('/', 'DashboardController@index');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('users', 'UserController@index');
    Route::get('users/{id}/delete', 'UserController@destroy');
    Route::get('users/{id}/edit', 'UserController@edit');
    Route::post('users/{id}/update', 'UserController@update');
    Route::get('users/new', 'UserController@create');
    Route::post('users', 'UserController@store');
});

//restaurant Routes
Route::group(['middleware'=> 'auth'],function(){
  Route::resource('restaurant','\App\Http\Controllers\RestaurantController');
  Route::post('restaurant/{id}/update','\App\Http\Controllers\RestaurantController@update');
  Route::get('restaurant/{id}/delete','\App\Http\Controllers\RestaurantController@destroy');
  Route::get('restaurant/{id}/deleteMsg','\App\Http\Controllers\RestaurantController@DeleteMsg');
});

//menu_item Routes
Route::group(['middleware'=> 'Auth'],function(){
  Route::resource('menu_item','\App\Http\Controllers\Menu_itemController');
  Route::post('menu_item/{id}/update','\App\Http\Controllers\Menu_itemController@update');
  Route::get('menu_item/{id}/delete','\App\Http\Controllers\Menu_itemController@destroy');
  Route::get('menu_item/{id}/deleteMsg','\App\Http\Controllers\Menu_itemController@DeleteMsg');
});


//order Routes
Route::group(['middleware'=> 'Auth'],function(){
  Route::resource('order','\App\Http\Controllers\OrderController');
  Route::post('order/{id}/update','\App\Http\Controllers\OrderController@update');
  Route::get('order/{id}/delete','\App\Http\Controllers\OrderController@destroy');
  Route::get('order/{id}/deleteMsg','\App\Http\Controllers\OrderController@DeleteMsg');
});


//order_item Routes
Route::group(['middleware'=> 'Auth'],function(){
  Route::resource('order_item','\App\Http\Controllers\Order_itemController');
  Route::post('order_item/{id}/update','\App\Http\Controllers\Order_itemController@update');
  Route::get('order_item/{id}/delete','\App\Http\Controllers\Order_itemController@destroy');
  Route::get('order_item/{id}/deleteMsg','\App\Http\Controllers\Order_itemController@DeleteMsg');
});
