<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test',function(){

$test=App\Models\governorate::paginate(10);


return responseJson(1,'success',$test);

});

Route::middleware('auth:api')->get('/client', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1','namespace'=>'Api'],function (){
Route::get('governorates','MainController@governorates');
Route::get('cities','MainController@cities');
Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
Route::get('blood-types','MainController@bloodTypes');
    Route::post('reset-password','AuthController@resetPassword');
    Route::post('new-password','AuthController@newPassword');

Route::group(['middleware'=>'auth:api'],function (){
    Route::get('posts','MainController@posts');
    Route::get('settings','MainController@settings');
    Route::post('contact','MainController@contact');
    Route::post('edit-profile','MainController@editProfile');
    Route::post('post','MainController@post');
    Route::post('notification-settings','MainController@notificationSettings');
    Route::post('toggle-favourite','MainController@toggleFavourite');
    Route::get('list-favourite','MainController@listFavourite');
    Route::get('donations','MainController@donations');
    Route::get('donation','MainController@donation');
    Route::post('create-donation','MainController@createDonation');
    Route::post('register-token','MainController@registerToken');
    Route::post('remove-token','MainController@removeToken');



});


});




// Route::get('governorates'  , function()
// {
// 	return App\Models\Governorate::all();
// });

// Route::post('update-notifications',function(Request $request){

// 	$use = $request->client();
// 	$valedation = validator()->make($request->all() , [
// 		'blood_type_id' => 'required',
// 		'governorate_id' => 'required',
// 	]);

// 	if($valedation->fails())
// 	{
// 		return $valedation->errors();
// 	}

// 	$client->blood_types()->sync($request->blood_type_id);
// 	$client->governorates()->sync($request->governorate_id);


// })
