<?php

/** author:Khadim Raath */
class BlogsController extends BaseController {

    public function index() {
        $blogs = Blog::where("permission", '=', '1')->get();
        return View::make('blogs.index', compact('blogs'))->withTitle("All Public Blogs");
    }

    public function create() {
        return View::make('blogs.create')->withTitle("Create New Blog");
    }

    public function store() {
        $blog = new Blog();
        $response = $blog->create_with_image();
        if ($response)
            return Redirect::route('user.index');
        else {
            return Redirect::back()->withErrors("Not created")->withInput();
        }
    }

    public function show($id) {
        $blog = Blog::findOrFail($id);
        return View::make('blogs.show', compact('blog'))->withTitle("Blog:-" . $blog->title);
    }

    public function edit($id) {
        $blog = Blog::find($id);

        return View::make('blogs.edit', compact('blog'))->withTitle("Blog Edit:-" . $blog->title);
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
    public function make_public() {
        
        $response=Blog::where('id', Request::input('blog_id'))->update(array('permission' => Request::input('permission')));
       // dd($response);
        return Redirect::back()->withErrors("Updated");
    }

}
