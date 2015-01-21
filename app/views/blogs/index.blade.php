@extends('layouts.default')
@section('content')
<div class="welcome">
    <h1>All Blogs</h1>
    <hr>
    @if($blogs)
    <div class="blogs">
    @foreach ($blogs as $blog)
    <div class="blog">
        <h3>{{ link_to_route('blog.show', $blog->title, ['id'=>$blog->id]); }}</h3>
        <p>Author:-{{ $blog->user()->first()->name }}</p>
        <div class="blog-body">
            <p>{{ Str::limit($blog->body,500) }}</p>
        </div>
        <div class="likes">
            <p> {{ $blog->likes }} Likes {{ link_to("blog/like/".$blog->id,"Like",['class'=>'likeit']) }}</p>
        </div>
    </div>
    @endforeach
    </div>
    @endif
</div>
@stop