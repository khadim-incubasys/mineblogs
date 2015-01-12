<?php

Route::get('login','UserController@login' );
Route::get('logout','UserController@logout' );
Route::resource('user', "UserController" );

//Route::get('user',function(){
//    
//})->before('auth');