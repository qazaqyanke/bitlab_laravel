<?php

use App\Http\Controllers\ChaptersController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\PaymentsController;
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
    return redirect()->route('login');
});

Route::prefix('courses')->group(function () {
    Route::get('/', 'CoursesController@index')->name('courses.index');
    Route::post('/', 'CoursesController@store')->name('courses.store');
    Route::get('/{course}/chapters', 'CoursesController@chapters')->name('courses.chapters');
    Route::put('/{course}', 'CoursesControlleR@update')->name('courses.update');
    Route::delete('/{course}', 'CoursesController@delete')->name('courses.delete');
});

Route::prefix('chapters')->group(function () {
    Route::get('/{chapter}/lessons', 'ChaptersController@lessons')->name('chapters.lessons');
    Route::delete('/{chapter}', 'ChaptersController@delete')->name('chapters.delete');
    Route::put('/{chapter}', 'ChaptersController@update')->name('chapters.update');
});

Route::prefix('lessons')->group(function () {
    Route::get('/create', 'LessonsController@create')->name('lessons.create');
    Route::get('/{lesson}', 'LessonsController@show')->name('lessons.show');
    Route::post('/', 'LessonsController@store')->name('lessons.store');
});

Route::prefix('payments')->group(function () {
    Route::get('/', 'PaymentsController@payment')->name('payments.payment');
    Route::get('/success/{payment}', 'PaymentsController@success')->name('payments.success');
    Route::get('/table', 'PaymentsController@table')->name('payments.table');
    Route::post('/', 'PaymentsController@proceed')->name('payments.proceed');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
