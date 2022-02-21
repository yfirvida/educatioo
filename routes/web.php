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

Route::get('/', function () { return view('welcome'); })->name('home');
//Route::post('/logout', '\App\Http\Controllers\Auth\AuthenticatedSessionController@destroy');

Route::group(['middleware' => ['web', 'admin'], 'namespace' => '\App\Http\Livewire\Admin'], function ()
{
	Route::get('/admin/dashboard', Dashboard::class)->name('admin_dashboard');
	Route::get('/admin/users', Users::class)->name('users');
	Route::get('/admin/lands', Lands::class)->name('lands');

	Route::get('/admin/profile', Profile::class)->name('profile');

	Route::get('/admin/help', Dashboard::class)->name('help');


});

Route::group(['middleware' => ['web', 'trainer'], 'namespace' => '\App\Http\Livewire\Trainer'], function ()
{
	Route::get('/trainer/dashboard', Dashboard::class)->name('trainer_dashboard');
	Route::get('/trainer/classrooms',Classrooms::class)->name('classrooms');
	Route::get('/trainer/courses',Courses::class)->name('courses');
	Route::get('/trainer/import',Import::class)->name('import');
	Route::get('/trainer/newcourse',Newcourse::class)->name('newcourse');
	Route::get('/trainer/edit-course',EditCourse::class)->name('edit-course');
	Route::get('/trainer/course-preview',CoursePreview::class)->name('course-preview');
	Route::get('/trainer/results',Results::class)->name('results');
	Route::get('/trainer/launch',Launch::class)->name('launch');
});

Route::group(['middleware' => ['web', 'student'], 'namespace' => '\App\Http\Livewire\Student'], function ()
{
	Route::get('/student/dashboard', Dashboard::class)->name('student_dashboard');
});

require __DIR__.'/auth.php';
