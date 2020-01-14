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

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('sign', 'SignUp@signin');

Route::get('signup', 'SignUp@signup')->name('signup');
Route::post('signup', 'SignUp@signup')->name('signup');

Route::get('logout', 'SignUp@logout')->name('logout');

Route::post('sign', 'SignUp@signin')->name('sign.store');


Route::get('dashboard', 'User\Dashboard@store')->name('dashboard');


Route::get('tests', 'User\Dashboard@test')->name('dashboard-tests');

Route::get('start-test', 'User\Dashboard@start_test')->name('dashboard-start-test');

Route::get('go-on', 'User\Dashboard@go_on')->name('go-on');


Route::get('load-tests', 'User\Dashboard@load_tests')->name('load-tests');

Route::post('end-test', 'User\Dashboard@end_test')->name('end-test');