<?php

Route::get('/', "HomeController@showWelcome");
Route::group(['before' => 'auth_not_user'], function() {
    Route::match(array('GET', 'POST'), 'user/login', 'UserController@login');
    Route::match(array('GET', 'POST'), 'user/register', 'UserController@register');
});

Route::group(['before' => 'auth'], function() {
    Route::resource('user', 'UserController');
    Route::get('user/logout', 'UserController@logout');
    Route::resource('blog', 'BlogsController', ['except' => ['show', 'index']]);
    Route::resource('comment', 'CommentsController', ['except' => ['show', 'index','create']]);
    Route::get('comment/create/{blog_id?}', "CommentsController@create");
});
Route::resource('blog', 'BlogsController', ['only' => ['index', 'show']]);
Route::resource('comment', 'CommentsController', ['only' => ['index', 'show']]);


Route::get('user_loginwith/{param}', 'UserController@social_login');
Route::get('auth/facebook/{process?}', array('as' => 'hybridauth', 'before' => 'guest', function($process = null) {
if ($process) {
    try {
        return Hybrid_Endpoint::process();
    } catch (Exception $e) {
        return Redirect::route('hybridauth');
    }
}
})
);
