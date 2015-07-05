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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('/ionic','IonicController@index');

Route::get('/ionic/detail/{id}','IonicController@detail');

Route::get('/ionic/test','IonicController@test');

Route::get('bootstrap','BootstrapController@index');

Route::get('/developer','DeveloperController@index');

Route::any('/developer/edit','DeveloperController@edit');

Route::any('/developer/test','DeveloperController@test');

Route::any('/buildinginfo','BuildingInfoController@index');

Route::any('/buildinginfo/buildings/{skip}/{take}','BuildingInfoController@buildings');

Route::any('/buildinginfo/building/{id}','BuildingInfoController@building');

Route::any('/buildinginfo/test','BuildingInfoController@test');

Route::any('/buildinginfo/edit','BuildingInfoController@edit');

Route::any('/propertycompany','PropertyCompanyController@index');

Route::any('/propertycompany/edit','PropertyCompanyController@edit');

Route::any('/photobatch','PhotoBatchController@index');

Route::any('/wedding','WeddingController@index');

Route::any('/wedding/result','WeddingController@result');

Route::any('/firebase','FirebaseController@index');

Route::any('/photobatch/index','PhotoBatchController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
