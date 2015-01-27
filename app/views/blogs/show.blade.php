@extends('layouts.default')
@section('content')
<div class="welcome">
    <h1 class="blog-title">{{ $blog->title }}</h1>
    <p><img class='lightbox' src="{{asset('uploads').'/'.$blog->imageUrl }}" > </p>
    <p>Author-:<span class="author-name">{{ $blog->user()->first()->name }}</span></p>
    <div>
        <p>{{ $blog->body }}</p>
    </div>
    <p> {{ $blog->likes }} Likes {{ link_to("blog/like/".$blog->id,"Like",['class'=>'likeit']) }}</p>

    <div class="comments">
        <h3>{{ link_to("comment/create/".$blog->id,"Add Comment") }}</h3>

        <div class="new-comment">
            {{ Form::open(['route' => ['comment.store'], 'method' => 'post','files'=>true]) }}
            <div>
                {{Form::textarea('description',Input::old('description'),  array('placeholder'=>'Write your comment')) }}
                {{Form::hidden('blog_id',$blog->id) }}

            </div>
            <div>
                {{ Form::label('file',"Choose Image") }}
                {{ Form::file('file','',array('id'=>'fileId','class'=>'file')) }}
            </div>
            <br>
            {{ Form::submit('Post',['class'=>'btn']) }}

            {{Form::close() }}
        </div>

        <h2>Comments</h2>

        <?php
        $comments = $blog->comments()->get();
        $c = 1;
        foreach ($comments as $comment) {
            if ($c == 1)
                $c = 2;
            else {
                $c = 1;
            }
            ?>
            <div class="comment{{$c}}">
                <p><img class='lightbox' src="{{ $comment->user()->first()->imageUrl }}" style="height: 50px"> </p>
                {{($comment['description'])}}
                <p class="created-by"> By: {{ $comment->user()->first()->name }}</p>
                <span  class="comment-likes"> {{ $comment['likes'] }} Likes {{ link_to("comment/like/".$comment['id'],"Like",['class'=>'likeit']) }}</span>
            </div>
        <?php } ?>

    </div>
</div>

@stop