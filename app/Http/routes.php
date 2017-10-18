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

Route::group(['middleware' => 'auth'], function() {
    Route::resource('dashboard', 'DashboardController');
    Route::get('/', 'DashboardController@index');
});

Route::group(['middleware' => ['auth','role:super_admin']], function() {
    Route::get('roles', 'RoleController@index');
    Route::get('roles/new', 'RoleController@create');
    Route::post('roles', 'RoleController@store');
    Route::get('roles/{id}/delete', 'RoleController@destroy');
    Route::get('roles/{id}/edit', 'RoleController@edit');
    Route::post('roles/{id}/update', 'RoleController@update');
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
});

//menu_item Routes
Route::group(['middleware'=> 'auth'],function(){
  Route::resource('menu_item','\App\Http\Controllers\Menu_itemController');
  Route::post('menu_item/{id}/update','\App\Http\Controllers\Menu_itemController@update');
  Route::get('menu_item/{id}/delete','\App\Http\Controllers\Menu_itemController@destroy');
});


//order Routes
Route::group(['middleware'=> 'auth'],function(){
  Route::resource('order','\App\Http\Controllers\OrderController');
  Route::post('order/{id}/update','\App\Http\Controllers\OrderController@update');
  Route::get('order/{id}/delete','\App\Http\Controllers\OrderController@destroy');
});


//order_item Routes
Route::group(['middleware'=> 'auth'],function(){
  Route::resource('order_item','\App\Http\Controllers\Order_itemController');
  Route::get('order_item/{id}/delete','\App\Http\Controllers\Order_itemController@destroy');
});

// Api Routes
Route::group(['prefix' => 'api/v1','middleware'=>'jwt.auth'], function() {
    Route::get('restaurants','Api\v1\ApiController@getRestaurants');
    Route::get('restaurants/{id}','Api\v1\ApiController@getRestaurant');
    Route::get('cart/view','Api\v1\ApiController@viewCart');
    Route::post('cart/add','Api\v1\ApiController@addItemToTheCart');
    Route::post('cart/add_area','Api\v1\ApiController@addArea');
    Route::post('cart/update','Api\v1\ApiController@updateQuantity');
    Route::delete('cart/remove/{rowId}','Api\v1\ApiController@removeItem');
    Route::delete('cart/destroy','Api\v1\ApiController@destryCart');
    Route::post('cart/place_order','Api\v1\ApiController@placeOrder'); 
});
Route::group(['prefix' => 'api/v1'], function() {
  Route::post('login', 'Api\AuthenticateController@login');
  Route::post('signup', 'Api\AuthenticateController@sign_up');
  Route::get('refresh_token', 'Api\AuthenticateController@refresh_token');
  Route::post('logout', 'Api\AuthenticateController@logout');
  Route::get('verification/{confirmation_code}', 'Api\AuthenticateController@confirm');
});
