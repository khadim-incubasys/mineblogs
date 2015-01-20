<?php

/** author:Khadim Raath */
class CommentsController extends BaseController {

    public function index() {
        $comments = Comment::all();
        return View::make('comments.index', compact('comments'));
    }

    public function create($blog_id = NULL) {
        return View::make('comments.create')->with("blog_id", $blog_id);
    }

    public function store() {
        $comment = new Comment();
        $response = $comment->create_with_image();
        if ($response) {
             return Redirect::route('blog.show',$response);
           
        } else {
            return Redirect::back()->withErrors("Not created")->withInput();
        }
    }

    public function show($id) {
        $comment = Comment::findOrFail($id);

        return View::make('comments.show', compact('comment'));
    }

    public function edit($id) {
        $comment = Comment::find($id);

        return View::make('comments.edit', compact('comment'));
    }

    public function update($id) {
        $comment = Comment::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Comment::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $comment->update($data);

        return Redirect::route('comments.index');
    }

    public function destroy($id) {
        Comment::destroy($id);

        return Redirect::route('comments.index');
    }

}
