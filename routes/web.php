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

Route::get('/', function () { return view('welcome'); });
//Route::post('/logout', '\App\Http\Controllers\Auth\AuthenticatedSessionController@destroy');

Route::group(['middleware' => ['web', 'auth', 'admin'], 'namespace' => '\App\Http\Livewire\Admin'], function ()
{
	Route::get('/admin/dashboard', Dashboard::class)->name('admin_dashboard');
	Route::get('/admin/users', Users::class)->name('users');
	Route::get('/admin/lands', Lands::class)->name('lands');
	Route::get('/admin/levels', Levels::class)->name('levels');
	Route::get('/admin/plans', Plans::class)->name('plans');

	Route::get('/admin/profile', Profile::class)->name('profile');

	Route::get('/admin/help', Dashboard::class)->name('help');


});

Route::group(['middleware' => ['web', 'auth', 'trainer'], 'namespace' => '\App\Http\Livewire\Trainer'], function ()
{
	Route::get('/trainer/dashboard', Dashboard::class)->name('trainer_dashboard');
	Route::get('/trainer/classrooms',Classrooms::class)->name('classrooms');
	Route::get('/trainer/courses',Courses::class)->name('courses');
	Route::get('/trainer/newcourse',Newcourse::class)->name('newcourse');
	Route::get('/trainer/results',Results::class)->name('results');
	Route::get('/trainer/launch',Launch::class)->name('launch');
});
Route::group(['middleware' => ['web', 'auth', 'student'], 'namespace' => '\App\Http\Livewire\Student'], function ()
{
	Route::get('/student/dashboard', Dashboard::class)->name('student_dashboard');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';
