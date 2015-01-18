<?php

class UserController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        
    }

    public function index() {
        return "User Index Page";
    }

    public function login() {
        if (Request::isMethod('post')) {
            $user_model = new User();
            $user = $user_model->login();
            dd($user);
        } else {
            return View::make("user/login")->withTitle("User Login");
        }
    }

    public function social_login($param) {
        $user = new User();
        $response= $user->social_logon($param);
        dd($response);
    }

    public function logout() {
        return "User Logout Page";
    }

    public function register() {
        if (Request::isMethod('post')) {
            $user_model = new User();
            $user = $user_model->register();
            dd($user);
        } else {
            return View::make("user/register")->withTitle("User Registration");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
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
