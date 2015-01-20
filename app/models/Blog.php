<?php

/** author:Khadim Raath */
class Blog extends Eloquent {

    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $guarded = array('id', 'status');
    public static $rules = ['title' => 'required', 'body' => 'required', 'file' => 'required|mimes:png,gif,jpeg'];
    // Don't forget to fill this array
    protected $fillable = ['title', 'body', 'user_id', 'imageUrl', 'likes'];

    public static function user() {
        return $this->hasOne('users');
    }

    public function create_with_image() {
        $data = Input::all();
        // dd($data);
        $validator = Validator::make($data, Blog::$rules);
        if ($validator->fails()) {
            Session::flash('error', 'Not Created. Something went wrong');
            return FALSE;
        } else {
            /////uploadingFile/////
            $dt = new DateTime;
            $ts = $dt->format('mdy_His');
            $file = Input::file('file');
            if ($file) {
                $filename = $file->getClientOriginalName();
                $filename = str_replace(" ", "_", $filename);
                $fileDesc = explode(".", $filename);
                $filename = $fileDesc[0] . $ts . '.' . $fileDesc[1];
                $data['imageUrl'] = $filename;
                $data['user_id'] = Auth::User()->id;
                $uploadPath = public_path() . '/uploads';
                $upload_success = $file->move($uploadPath, $filename);
                /////////////////////////
                if ($upload_success) {
                    Blog::create($data);
                    Session::flash('error', 'Created successfully');
                    return TRUE;
                }
            }
            Session::flash('error', 'Not Created. Something went wrong');
            return FALSE;
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
