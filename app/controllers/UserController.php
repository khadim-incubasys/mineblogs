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
            $blogs = Blog::all();
            return View::make('blogs.index', compact('blogs'));
        } else {
            return Redirect::to('/user/login');
        }
    }

    public function login() {
        // print_r(isMethod('post'));
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
        echo 'log out';
    }

    public function register() {
        if (Request::isMethod('post')) {
            $user_model = new User();
            $user = $user_model->register();
            if (!$user) {
                return View::make("user/register")->withTitle("User Registration");
            }
            return Redirect::route('user/login')->withError("Registered Successfully");
        } else {
            return View::make("user/register")->withTitle("User Registration");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function updatepassword() {
        return View::make('users.updatepassword');
    }

    public function changepassword() {
        return "page";
    }

    public function create1() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $user = User::where('id', $id)->first();
        if ($user) {
            return View::make("user/show", compact('user'));
        }
        App::abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::where('id', $id)->first();
        if ($user) {
            return View::make("user/edit", compact('user'));
        }
        echo 'User Not Exist';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user_model = new User();
        $response = $user_model->update_user($id);
        if (!$response) {
            return Redirect::back()->withError(['Login failed.']);
        }
        return Redirect::route('user.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
