@extends('layouts.default')
@section('content')
<div class="welcome">
    <h1>{{ $title }}</h1>
    <hr>
    @if($blogs)
    <div class="blogs">
        @foreach ($blogs as $blog)
        <div class="blog">
            <h3 class="blog-title">{{ link_to_route('blog.show', $blog->title, ['id'=>$blog->id]); }}</h3>
            <p>Author-:<span class="author-name">{{ $blog->user()->first()->name }}</span></p>
            <div class="blog-body">
                <p>{{ Str::limit($blog->body,500) }}</p>
            </div>
            <div>
                <span class="public-dropdown">
                    {{Form::hidden('blog_id',$blog->id,['id'=>'blog_id']) }} 
                    {{ Form::select('permission', array('' => '--','0' => 'me', '1' => 'public'), $blog->permission,['id'=>'dropdown_change']) }}
                </span>
                <span class="likes">  <span class="like-count"> {{ $blog->likes }} </span> Likes</span>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@stop