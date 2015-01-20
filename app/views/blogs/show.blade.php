@extends('layouts.default')
@section('content')
<div class="welcome">
    <h1 class="row">{{ $blog->title }}</h1>
    <p><img src="{{asset('uploads').'/'.$blog->imageUrl }}" > </p>
    <p>Author:{{  User::find($blog->user_id)->name; }}</p>
    <div>
        <p>{{ $blog->body }}</p>
    </div>
    <div class="comments">
         <h3>{{ link_to("comment/create/".$blog->id,"Add Comment") }}</h3>
        
        <h2>All Comments</h2>
        <div class="comment">
            xddsfsdfd
        </div>
    </div>
</div>

@stop