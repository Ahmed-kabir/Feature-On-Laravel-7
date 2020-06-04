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

Route::get('/login','Login@index');
Route::get('/register','Login@register');
Route::get('/logout','Login@logout');
Route::post('/loginVerify','Login@loginVerify');


Route::post('/save/userinfo','Login@saveUser');
Route::post('/setPasswordForsession','Login@setPasswordForsession');
Route::post('/checkPasswordForsession','Login@checkPasswordForsession');

Route::group(['middleware'=>['Login']],function(){

Route::get('/dashboard','Login@dashboard');

});