<?php

/** author:Khadim Raath */
class BlogsController extends BaseController {

    public function index() {
//        $Blog=new Blog();
//        $Blog::find(1)->user();//('user', 'user_id');
//        dd();
        $blogs = Blog::all();

        return View::make('blogs.index', compact('blogs'));
    }

    public function create() {
        return View::make('blogs.create');
    }

    public function store() {
        $blog = new Blog();
        $response = $blog->create_with_image();
        if ($response)
            return Redirect::route('blog.index');
        else {
            return Redirect::back()->withErrors("Not created")->withInput();
        }
    }

    public function show($id) {
        $blog = Blog::findOrFail($id);
        return View::make('blogs.show', compact('blog'));
    }

    public function edit($id) {
        $blog = Blog::find($id);

        return View::make('blogs.edit', compact('blog'));
    }

    public function update($id) {
        $blog = Blog::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Blog::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $blog->update($data);

        return Redirect::route('blogs.index');
    }

    public function destroy($id) {
        Blog::destroy($id);

        return Redirect::route('blogs.index');
    }

    public function likeit($blog_id) {
        $blog = Blog::findOrFail($blog_id);
        $blog->increment('likes');
        return Redirect::back();
    }

}
