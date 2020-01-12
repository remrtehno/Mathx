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

Route::get('/clear', function () {

Artisan::call('cache:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');
Artisan::call('route:clear');
Artisan::call('clear-compiled');
Artisan::call('config:cache');

return '<h1>Cache facade value cleared </h1>';});

Route::get('/', function () {

    return view('welcome');
});


Route::get('/register', function () {
	return view('welcome');
});


Route::get('sign', 'SignUp@signin');

Route::get('signup', 'SignUp@signup')->name('signup');
Route::post('signup', 'SignUp@signup')->name('signup');

Route::get('logout', 'SignUp@logout')->name('logout');

Route::post('sign', 'SignUp@signin')->name('sign.store');


Route::get('dashboard', 'User\Dashboard@store')->name('dashboard');


Route::get('tests', 'User\Dashboard@test')->name('dashboard-tests');

Route::get('start-test', 'User\Dashboard@start_test')->name('dashboard-start-test');