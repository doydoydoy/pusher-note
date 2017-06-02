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

Auth::routes();

// Route::resource('notes', 'NoteController');
Route::get('/', 'NoteController@index');

// Retrieve notes information
Route::get('/note', 'NoteController@create');

// Save information of a note
Route::post('/note', 'NoteController@update');

// Get note information
Route::get('/note/{noteId}', 'NoteController@show');

// Create new note
Route::post('/notes', 'NoteController@store');

// Delete a note
Route::delete('/note/{noteId}', 'NoteController@destroy');