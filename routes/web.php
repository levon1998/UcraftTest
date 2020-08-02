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
    return view('home');
});

Auth::routes(['verify' => true]);
Route::get('/google-redirect', 'SocialAuthGoogleController@redirect');
Route::get('/google-callback', 'SocialAuthGoogleController@callback');

Route::group(['middleware' => ['auth', 'verified', 'checkHasNotWallet']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/wallets', 'WalletController@index')->name('wallets');
    Route::get('/add-wallet', 'WalletController@create')->name('addWallet');
    Route::post('/store-wallet', 'WalletController@store')->name('storeWallet');
    Route::post('/wallet/delete', 'WalletController@delete')->name('deleteWallet');
    Route::get('/wallet/{id}', 'WalletController@edit')->name('editWallet');
    Route::post('/wallet/{id}', 'WalletController@update')->name('updateWallet');

    Route::post('/save', 'TransactionController@store')->name('storeTransaction');

    Route::get('/report', 'ReportController@index')->name('report');

});

Route::group(['middleware' => ['auth', 'verified', 'checkHasWallet']], function () {

    Route::get('/create-wallet', 'WalletController@createWallet')->name('createWallet');
    Route::post('/create-wallet', 'WalletController@store')->name('storeFirstWallet');

});




