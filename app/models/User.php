<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
    //use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $fillable = array('email', 'password', 'name');
    protected $guarded = array('id', 'status');
    public static $rules = ['name' => 'required', 'email' => 'required', 'password' => 'required'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function blogs() {
        return $this->hasMany('blogs');
    }

    public function my_blogs() {
        return $this->hasMany('my_blogs');
    }

    public function login() {
        $email = Request::input('email');
        $password = Request::input('password');

        $user = DB::table('users')->where('email', $email)->first();
        print_r($user->password.'  <br>  ');
        print_r(Hash::make("123456").'<br>');
        if ($user->password==Hash::make($password)) {
            return 'match';
        } else {
            return 'not match';
        }
        if (Auth::attempt(array('email' => $email, 'password' => Hash::make($password)))) {
            return Auth::User();
        } else {
            return "authenticatation failed";
        }
    }

    public function social_logon($param) {
        $userProfile = NULL;
        try {
            // create a HybridAth object
            $config = Config::get('hybridauth');
            // dd($config);
            $socialAuth = new Hybrid_Auth($config);
            // authenticate with Google
            $provider = $socialAuth->authenticate($param);
            // fetch user profile
            $userProfile = $provider->getUserProfile();
        } catch (Exception $e) {
            // exception codes can be found on HybBridAuth's web site
            return $e->getMessage();
        }
        // logout
        $provider->logout();
        return $userProfile;
    }

    public function register() {
        // $this->create(Request::input());

        $validator = Validator::make(
                        array(
                    'name' => Request::input('name'),
                    'password' => "123456", //Request::input('password'),
                    'email' => Request::input('email')
                        ), array(
                    'name' => 'required',
                    'password' => 'required|min:6',
                    'email' => 'required|email|unique:users'
                        )
        );
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages;
        } else {
            $password = Hash::make("123456"); // Hash::make(Request::input('password')); 
            $this->create([
                'password' => $password,
                'email' => Request::input('email'),
                'name' => Request::input('name')
                    ]
            );
            $insertedId = $this->id;
            return $insertedId;
        }
    }

    public function getAuthIdentifier() {
        return $this->email;
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

    public function getReminderEmail() {
        
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

}
