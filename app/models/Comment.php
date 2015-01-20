<?php

/** author:Khadim Raath */
class Comment extends Eloquent {

    protected $table = "comments";
    protected $primaryKey = 'id';
    // Add your validation rules here
    public static $rules = [ 'description' => 'required', 'blog_id' => 'required'];
    // Don't forget to fill this array
    protected $fillable = ['description', 'user_id', 'blog_id', 'likes', 'imageUrl'];
    protected $guarded = array('id', 'status');

    public function create_with_image() {
        $data = Input::all();
        $validator = Validator::make($data, Comment::$rules);
        if ($validator->fails()) {
            //dd($validator->messages());
            Session::flash('error', 'Not Created. Something went wrong');
            return FALSE;
        } else {
            /////uploadingFile/////
            $dt = new DateTime;
            $ts = $dt->format('mdy_His');
            $data['user_id'] = Auth::User()->id;
            $file = Input::file('file');
            if ($file) {
                $filename = $file->getClientOriginalName();
                $filename = str_replace(" ", "_", $filename);
                $fileDesc = explode(".", $filename);
                $filename = $fileDesc[0] . $ts . '.' . $fileDesc[1];
                $data['imageUrl'] = $filename;

                $uploadPath = public_path() . '/uploads';
                $upload_success = $file->move($uploadPath, $filename);
            }
            /////////////////////////
            Comment::create($data);
            Session::flash('error', 'Created successfully');
            return $data['blog_id'];
        }
    }

    public function getAuthIdentifier() {
        return $this->id;
    }

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

}
