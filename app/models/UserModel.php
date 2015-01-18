<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserModel extends Eloquent implements UserInterface, RemindableInterface {
    //use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function login() {
        $email = Request::input('email');
        $password = Request::input('password');
        $user = DB::table($table)->where('email','=',$email)->get();
        dd($user);
    }

    public function register() {
        $email = Request::input('email');
        $password = Request::input('password');
        $user = new User;
        $user->email = $email;
        $user->password = $password;
        $user->name = Request::input('name');
        $user->status = 1;
        $user->token = "kkkkkkkk";
        $user->save();
    }

    public function getAuthIdentifier() {
        
    }

    public function getAuthPassword() {
        
    }

    public function getRememberToken() {
        
    }

    public function getRememberTokenName() {
        
    }

    public function getReminderEmail() {
        
    }

    public function setRememberToken($value) {
        
    }

}
