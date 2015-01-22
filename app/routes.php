<?php


Route::group(['before' => 'auth_not_user'], function() {
    Route::match(array('GET', 'POST'), 'user/login', 'UserController@login');
    Route::resource('user', 'UserController', ['only' => ['create', 'store']]);
    Route::get('/', "HomeController@showWelcome");
});

Route::group(['before' => 'auth'], function() {
    Route::get('user/logout', 'UserController@logout');
    Route::get('user/update_password', "UserController@update_password");
    Route::post('user/change_password', "UserController@change_password");
    Route::resource('user', 'UserController', ['except' => ['create', 'store']]);

    Route::get('blog/like/{blog_id}', "BlogsController@likeit");
    Route::post('blog/makepublic', "BlogsController@make_public");
    Route::resource('blog', 'BlogsController', ['except' => ['show', 'index']]);

    Route::resource('comment', 'CommentsController', ['except' => ['show', 'index']]);
    Route::get('comment/create/{blog_id?}', "CommentsController@create");
    Route::get('comment/like/{comment_id}', "CommentsController@likeit");
});

Route::resource('blog', 'BlogsController', ['only' => ['index', 'show']]);
Route::resource('comment', 'CommentsController', ['only' => ['index', 'show']]);



Route::get('user/loginwith/{param}', 'UserController@social_login');
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
