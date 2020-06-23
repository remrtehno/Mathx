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

Route::get('get-start', 'User\Dashboard@get_start')->name('get-start');

Route::get('go-on', 'User\Dashboard@go_on')->name('go-on');

Route::get('load-tests', 'User\Dashboard@load_tests')->name('load-tests');

Route::post('end-test', 'User\Dashboard@end_test')->name('end-test');

Route::get('switcher-theme', 'User\Dashboard@switcher_theme')->name('switcher-theme');

Route::get('code-examples', 'User\CodeExamples@index')->name('code-examples');

Route::get('kniga-resheniy', 'User\KnigaResheniy@index')->name('kniga-resheniy');

Route::get('teoriya/{table}', 'User\KnigaResheniy@index')->name('teoriya');

Route::get('sub-chapter', 'User\KnigaResheniy@getChapter')->name('sub-chapter');

Route::post('save-meta', 'User\Dashboard@save_meta')->name('save-meta');

Route::post('level-up', 'User\Level@up')->name('level-up');



