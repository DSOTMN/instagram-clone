<?php

use Illuminate\Support\Facades\Route;

use \App\Mail\WelcomeEmail;

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

Route::post('follow/{user}', 'App\Http\Controllers\FollowerController@store');

Auth::routes();

Route::get('/email', function(){
    return new WelcomeEmail();
});


// router za home/index page i prikaz postova 
Route::get('/', 'App\Http\Controllers\postsController@index');
// ovdje pravim route za postove - pomoću GET metode (php laravel http metode pogledaj) za create - sa .create metodom
// url nastavak dajem /p jer tako izgleda post nastavak u originalnom instagramu.
// koristim postsController koji ću poslije ovoga napraviti unutar controllera naravno.
// /create i slični idu iznad /{post} jer ovaj drugi hvata sve iza kose crte, pa je redoslijed bitan!
Route::get('/p/create', 'App\Http\Controllers\postsController@create');

// route za show postove
Route::get('/p/{post}', 'App\Http\Controllers\postsController@show');

//ovo je route za upload/spremanje slika na server- putem store metode a action je /p kao na stranici create.php
Route::post('/p', 'App\Http\Controllers\postsController@store');

//edit profile route
Route::get('/profile/{user}/{edit}', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit');

// profile update route
Route::patch('/profile/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update'); 

// view/show profile route
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
