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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', 'DashBoardController@index')->name('dashboard');
    Route::put('/edit-task', 'TaskController@editTask')->name('edit.task');
    Route::get('/load-edit-task-modal/{id}', 'TaskController@loadEditModel')->name('load.edit.model');
	Route::post('/save-task', 'TaskController@storeTask')->name('add.task');
	Route::post('/complete-task', 'TaskController@completeTask')->name('complete.task');
	Route::delete('/delete-task', 'TaskController@deleteTask')->name('delete.task');
	Route::get('/chart', 'TaskController@getChart')->name('tasks.chart');
});
