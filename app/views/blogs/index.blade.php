@extends('layouts.default')
@section('content')
<div class="welcome">
    <h1>All Blogs</h1>
    <hr>
    @if($blogs)
    @foreach ($blogs as $blog)
    <div>
        <h3>{{ link_to_route('blog.show', $blog->title, ['id'=>$blog->id]); }}</h3>
         <p>Author:{{  User::find($blog->user_id)->name; }}</p>
        <p>{{ Str::limit($blog->body,100) }}</p>
    </div>
    @endforeach
    @endif
</div>
@stop