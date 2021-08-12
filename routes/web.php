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
Route::resource('journalists','JournalistController');
Route::resource('branches','BrancheController');
Route::resource('magazines','MagazineController');
Route::resource('employs','EmployController');
Route::resource('copies','CopyController');
Route::resource('sections','SectionController');
Route::resource('journalist_magazines','Journalist_magazineController');
Route::resource('branche_magazines','Branche_magazineController');

