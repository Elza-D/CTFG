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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'Guest\GuestController@index');
Route::get('/projects/add', 'Projects\ProjectController@add');
Route::get('/listing/{slug}', 'Projects\ProjectController@singleProject');
Route::get('/projects/autocomplete', 'Projects\ProjectController@searchAutoComplete')->name('autocomplete');
Route::get('/listings/search', 'Projects\ProjectController@search');

Route::get('/category/parent/the-tech', 'Category\ParentCategoryController@theTech');
Route::get('/category/parent/the-people', 'Category\ParentCategoryController@thePeople');

Route::get('/listing-category/{slug}', 'Category\ProjectController@getProjectsByCategory');
Route::get('/listing-tag/{name}', 'Category\ProjectController@getProjectsByTag');

Route::get('/a/test/a', 'Airtable\ImportsController@testa');
Route::get('/a/test/b', 'Airtable\ImportsController@testb');
Route::get('/a/test/c', 'Airtable\ImportsController@testc');
Route::get('/a/test/d', 'Airtable\ImportsController@testd');
Route::get('/a/test/e', 'Airtable\ImportsController@teste');
Route::get('/a/test/f', 'Airtable\ImportsController@testf');
Route::get('/a/test/g', 'Airtable\ImportsController@testg');
Route::get('/a/test/h', 'Airtable\ImportsController@testh');


Route::get('/t', 'TestController@test');



