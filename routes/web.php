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

Route::get('/', "ActivitiesController@index")->name("home");
Route::group(['middleware'], function () {
    Route::post('/create', 'ActivitiesController@createActivities')->name("add-activities");
    Route::get('/delete/{id}', 'ActivitiesController@deleteActivities')->name("delete-activities");
    Route::post('/set-done', 'ActivitiesController@updateDoneActivities')->name("done-activities");
});

