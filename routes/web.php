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

Route::get('/invite_by_mail', 'MailController@invitation_mail')->name('invite_by_mail')->middleware('auth');

Route::get('/register', 'HomeController@register')->name('register');

Route::group( ['middleware' => ['auth']], function() {
    Route::resource('roles', 'RoleController');
    Route::resource('leizis', 'LeiziController');
    Route::resource('groups', 'GroupController');
    Route::resource('apollo', 'ApolloController');
    Route::resource('seshats', 'SeshatController');
    Route::resource('users', 'UserController');
    Route::resource('invite', 'InviteController');
    Route::resource('zalmos', 'ZalmoController');
    Route::resource('gaias','GaiaController');
    Route::resource('africas','AfricaController');
    Route::resource('odins','OdinController');
    Route::resource('tyches','TycheController');
    Route::resource('walas','WalaController');
    Route::resource('walaqs','WalaqController');
    Route::resource('kadlus','KadluController');
    Route::resource('kadluqs','KadluqController');
    Route::resource('nuwas','NuwaController');

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

    //    leizi
    Route::delete('leizidel', 'LeiziController@deleteAll')->name('leizidel');
    Route::put('leizival', 'LeiziController@validateAll')->name('leizival');
    Route::get('lexport', 'LeiziController@export')->name('lexport');
    Route::get('sampleleizi', 'LeiziController@getDownload')->name('sampleleizi');
    //Odin
    Route::delete('odindel', 'OdinController@deleteAll')->name('odindel');
    Route::put('odinval', 'OdinController@validateAll')->name('odinval');
    Route::get('oexport', 'OdinController@export')->name('oexport');
    Route::get('sampleodin', 'OdinController@getDownload')->name('sampleodin');

    //Tyche
    Route::delete('tychedel', 'TycheController@deleteAll')->name('tychedel');
    Route::put('tycheval', 'TycheController@validateAll')->name('tycheval');
    Route::get('texport', 'TycheController@export')->name('texport');
    Route::get('sampletyche', 'TycheController@getDownload')->name('sampletyche');
// Wala
    Route::delete('waladel', 'WalaController@deleteAll')->name('waladel');
    Route::put('walaval', 'WalaController@validateAll')->name('walaval');

    // Walaq
    Route::delete('walaqdel', 'WalaqController@deleteAll')->name('walaqdel');
    Route::put('walaqval', 'WalaqController@validateAll')->name('walaqval');
    // kadlu
    Route::delete('kadlusdel', 'KadluController@deleteAll')->name('kadlusdel');
    Route::put('kadlusval', 'KadluController@validateAll')->name('kadlusval');

    // kadluq
    Route::delete('kadluqsdel', 'KadluqController@deleteAll')->name('kadluqsdel');
    Route::put('kadluqsval', 'KadluqController@validateAll')->name('kadluqsval');

//    Nuwa
    Route::get('nuwadownload', 'NuwaController@getDownload')->name('nuwadownload');
    Route::delete('nuwadel', 'NuwaController@deleteAll')->name('nuwadel');
    Route::put('nuwaval', 'NuwaController@validateAll')->name('nuwaval');
    Route::get('nuwaexport', 'NuwaController@export')->name('nuwaexport');

});



