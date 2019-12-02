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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes((['register' => false]));

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group( ['middleware' => ['auth']], function() {
    Route::resource('roles', 'RoleController');
    Route::resource('groups', 'GroupController');
    Route::resource('apollo', 'ApolloController');
    Route::resource('seshats', 'SeshatController');
    Route::resource('users', 'UserController');
    Route::resource('zalmos', 'ZalmoController');
    Route::resource('gaias','GaiaController');
    Route::resource('africas','AfricaController');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::get('export', 'ZalmoController@export')->name('export');
    Route::get('download', 'ZalmoController@getDownload')->name('download');
    Route::post('import', 'ZalmoController@import')->name('import');
    Route::post('bulkapollo', 'ApolloController@bulkupload')->name('bulkapollo');
    Route::get('bulkapollo', 'ApolloController@bulkview')->name('apolloview');
    Route::get('exportapollo', 'ApolloController@export')->name('apollexport');
    Route::get('sampleapollo', 'ApolloController@getDownload')->name('sampleapollo');
    Route::get('gexport', 'GaiaController@export')->name('gexport');
    Route::get('aexport', 'AfricaController@export')->name('aexport');
    Route::get('seshatexport', 'SeshatController@export')->name('seshatexport');
    Route::get('sampleafrica', 'AfricaController@getDownload')->name('sampleafrica');

    Route::post('apollo/send',['as'=>'apollo.send','uses'=>'ApolloController@send']);
//    apollo
    Route::delete('apollodel', 'ApolloController@deleteAll')->name('apollodel');
    Route::put('apolloval', 'ApolloController@validateAll')->name('apolloval');
//    seshat
    Route::delete('seshatdel', 'SeshatController@deleteAll')->name('seshatdel');
    Route::put('seshatval', 'SeshatController@validateAll')->name('seshatval');
    //    zalmo
    Route::delete('zalmodel', 'ZalmoController@deleteAll')->name('zalmodel');
    Route::put('zalmoval', 'ZalmoController@validateAll')->name('zalmoval');

    //    gaia
    Route::delete('gaiadel', 'GaiaController@deleteAll')->name('gaiadel');
    Route::put('gaiaval', 'GaiaController@validateAll')->name('gaiaval');

    //    africa
    Route::delete('africadel', 'AfricaController@deleteAll')->name('africadel');
    Route::put('africaval', 'AfricaController@validateAll')->name('africaval');

});



