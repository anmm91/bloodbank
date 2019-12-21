<?php

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

Route::get('/','FrontController@index');


//front end

Route::group(['prefix' => 'front'], function () {
    Route::get('signup', 'FrontController@signup');
    Route::post('signup', 'FrontController@postSignup');
    Route::get('login', 'FrontController@login');
    Route::post('login', 'FrontController@postLogin');
    Route::post('logout', function (){
        auth('client')->logout();
    });

    Route::group(['middleware'=>'auth:client'],function(){

//mostafa

    Route::get('index', 'FrontController@index');

    Route::get('about-us', 'FrontController@aboutus');
    Route::get('donations', 'FrontController@donations');
    Route::get('create-donations', 'FrontController@createDonation');
    Route::get('donation/{id}', 'FrontController@donation');
    Route::get('who-are-you', 'FrontController@who');
    Route::get('contact-us', 'FrontController@contactus');

//   Route::get('articles','FrontController@articles');
    Route::get('article/{id}', 'FrontController@article');
    Route::get('toggle', 'FrontController@index');
    Route::post('toggle-favourite', 'FrontController@toggleFavourite')->name('toggle-favourite');

    });
});


Auth::routes();

Route::group(['middleware' => ['auth:web', 'admin-activation', 'auto-check-permission']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/governorate', 'GovernorateController');
    Route::resource('/city', 'CityController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/post', 'PostController');//
    Route::resource('/contact', 'ContactController');//show,delete
    Route::resource('/donation-request', 'DonationRequestController');//
//    Route::resource('/blood-type', 'ContactController');
    Route::resource('/client', 'ClientController');//
    Route::resource('/setting', 'SettingController');//show,edit
    Route::resource('/user', 'UserController');//
    Route::get('/reset-password', 'UserController@indexPassword');//
    Route::post('/reset-password', 'UserController@reset');//

    Route::resource('/role', 'RoleController');
    Route::get('/is-active/{id}', 'UserController@activation')->name('users.activation');

});
