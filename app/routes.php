<?php

Route::get('/',"HomeController@showWelcome");

Route::get('user/login','UserController@login' );
Route::post('user/login','UserController@login' );
Route::get('user/register','UserController@register' );
Route::post('user/register','UserController@register' );
Route::get('user/logout','UserController@logout' );
Route::resource('user', "UserController" );