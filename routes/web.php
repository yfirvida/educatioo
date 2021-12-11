<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['web'], 'namespace' => '\App\Http\Livewire\Admin'], function ()
{
	Route::get('/admin/dashboard', Dashboard::class)->name('dashboard');
	Route::get('/admin/users', Users::class)->name('users');
	Route::get('/admin/lands', Lands::class)->name('lands');
	Route::get('/admin/levels', Levels::class)->name('levels');
	Route::get('/admin/plans', Plans::class)->name('plans');

	Route::get('/admin/profile', Profile::class)->name('profile');

	Route::get('/admin/help', Dashboard::class)->name('help');


});
/*Route::group(['middleware'=> ['web', 'setTheme:educatioo']] , function()
{
    Route::post('/login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::get('/', 'HomeController@home');
});*/
