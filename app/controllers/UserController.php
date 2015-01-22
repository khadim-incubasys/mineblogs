<?php

class UserController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        // $this->filter('before', 'auth');
    }

    public function index() {
        if (Auth::check()) {
            //return View::make("user/index")->withTitle("User-Home Page");
            $user = Auth::User();
            $blogs = $user->blogs()->get();
            return View::make('user.index', compact('blogs'))->withTitle("My Blogs");
        } else {
            return Redirect::to('/user/login');
        }
    }

    public function login() {
        if (Request::isMethod('post')) {
            $user_model = new User();
            $response = $user_model->login();
            if (!$response) {
                return Redirect::back()->withError(['Login failed.']);
            }
            return Redirect::route('user.index'); //->with('name', $name);
        } else {
            return View::make("user/login")->withTitle("User Login");
        }
    }

    public function social_login($param) {
        $user = new User();
        $response = $user->social_signon($param);
        if (!$response) {
            return Redirect::back()->withError(['Login failed.']);
        }
        return Redirect::route('user.index');
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }

    public function create() {
        return View::make("user.create")->withTitle("User Registration");
    }

    public function store() {
        $user_model = new User();
        $user = $user_model->register();
        if (!$user) {
            return Redirect::back()->withError(['Registration Failed']);
        }
        return Redirect::to('/user/login')->withError("Registered Successfully");
    }

    public function show($id) {
        $user = User::where('id', $id)->first();
        if ($user) {
            return View::make("user/show", compact('user'))->withTitle($user->name);
        }
        App::abort(404);
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();
        if ($user) {
            return View::make("user/edit", compact('user'));
        }
        echo 'User Not Exist';
    }

    public function destroy($id) {
        //
    }

    public function update($id) {
        $user_model = new User();
        $response = $user_model->update_user($id);
        if (!$response) {
            return Redirect::back()->withError(['Login failed.']);
        }
        return Redirect::route('user.show', $id);
    }

    public function update_password() {
        return View::make('user.updatepassword')->withTitle("Update Password");
    }

    public function change_password() {
        $response=Auth::User()->updatePassword();
       // dd($response);
        return Redirect::back()->withError(['Password Updated ']);
    }

}
