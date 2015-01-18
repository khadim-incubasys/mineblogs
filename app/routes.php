<?php

Route::get('/', "HomeController@showWelcome");

Route::match(array('GET', 'POST'), 'user/login', 'UserController@login');
Route::get('user/register', 'UserController@register');
Route::post('user/register', 'UserController@register');
Route::get('user/logout', 'UserController@logout');
Route::resource('user', "UserController");
Route::resource('dog', "DogsController");

Route::get('user/loginwith/{param}', 'UserController@social_login');

Route::get('auth/facebook/{process?}',
    array('as' => 'hybridauth', 'before' => 'guest', function($process = null)
    {
        if ($process)
        {
            try
            {
                return Hybrid_Endpoint::process();
            }
            catch (Exception $e)
            {
                return Redirect::route('hybridauth');
            }
        }
    })
);