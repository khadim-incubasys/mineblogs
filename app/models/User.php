<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class User extends Eloquent implements UserInterface, RemindableInterface {
    //use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = array('email', 'password', 'name', 'city', 'country', 'imageUrl');
    protected $guarded = array('id', 'status');
    public static $rules = ['name' => 'required', 'email' => 'required', 'password' => 'required'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function blogs() {
        return $this->hasMany('Blog');
    }

    public function my_blogs() {
        return $this->hasMany('my_blogs');
    }

    public function login() {
        $email = Request::input('email');
        $password = Request::input('password');
        if (Auth::attempt(array('email' => $email, 'password' => $password))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function social_signon($param) {
        try {
            // create a HybridAth object
            $config = Config::get('hybridauth');
            // dd($config);
            $socialAuth = new Hybrid_Auth($config);
            // authenticate with Google
            $provider = $socialAuth->authenticate($param);
            // fetch user profile
            $userProfile = $provider->getUserProfile();

            $provider->logout();

//            $user = DB::table('users')->where('email', $userProfile->email)->first();
            $user = $this->whereEmail($userProfile->email)->first();
            if (!$user) {
                $password = str_random(10); //$this->generatePassword();
                $this->create([
                    'password' => Hash::make($password),
                    'email' => $userProfile->email,
                    'name' => $userProfile->firstName . ' ' . $userProfile->lastName,
                    'imageUrl' => $userProfile->photoURL,
                    'city' => $userProfile->city,
                    'country' => $userProfile->country,
                    'status' => 1
                        ]
                );
                $user = $this->whereEmail($userProfile->email)->first();
            }
            if (Auth::loginUsingId($user->id)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            // exception codes can be found on HybBridAuth's web site
            return FALSE; //$e->getMessage();
        }
    }

    public function register() {
        // $this->create(Request::input());

        $validator = Validator::make(
                        array(
                    'name' => Request::input('name'),
                    'password' => "123456", //Request::input('password'),
                    'email' => Request::input('email'),
                    'city' => Request::input('city'),
                    'country' => Request::input('country'),
                        ), array(
                    'name' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                    'password' => 'required|min:6',
                    'email' => 'required|email|unique:users'
                        )
        );
        if ($validator->fails()) {
            $messages = $validator->messages();
            return FALSE;
        } else {
            $password = Hash::make("123456"); // Hash::make(Request::input('password')); 
            $this->create([
                'password' => $password,
                'email' => Request::input('email'),
                'name' => Request::input('name'),
                'city' => Request::input('city'),
                'country' => Request::input('country')
                    ]
            );
            return TRUE;
        }
    }

    public function update_user($id) {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->name = Request::input('name');
            $user->city = Request::input('city');
            $user->country = Request::input('country');
            $user->save();
            return TRUE;
        }
        return FALSE;
    }

    public function getAuthIdentifier() {
        return $this->id;
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
        return $this->email;
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function setPassword($password) {
        $this->password = Hash::make($password);
    }

}

App::error(function(ModelNotFoundException $e) {
    return Response::make('Not Found', 404);
});
