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
    public static $rules = ['name' => 'required', 'email' => 'required|email', 'password' => 'required|confirmed|min:6', 'password_confirmation' => 'required|min:6', 'city' => 'required', 'country' => 'required'];

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
        $data = Input::all();
        $validator = Validator::make($data, User::$rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return FALSE;
        } else {
            $data['password'] = Hash::make($data['password']); // Hash::make(Request::input('password')); 
            $this->create($data);
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
        $this->save();
    }

    public function setPassword($password) {
        $this->password = Hash::make($password);
        return $this->save();
    }

    public function updatePassword() {
        $data=Input::all();
        $validator = Validator::make(array("password" => $data['password'], "password_confirmation" => $data['password_confirmation']), array('password' => User::$rules['password'], 'password_confirmation' => User::$rules['password_confirmation']));
        if ($validator->fails()) {
            $messages = $validator->messages();
            return FALSE;
        }
       // print_r($this->password.'='.Hash::make($data['old_password']));
        if (Hash::check($this->password, $data['old_password'])) {
            $this->setPassword($data['password']);
            return TRUE;
        }
        return FALSE;
    }

}

App::error(function(ModelNotFoundException $e) {
    return Response::make('Not Found', 404);
});
