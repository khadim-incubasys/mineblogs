@extends('layouts.default')
@section('content')
<div class="welcome">
    <h1 class="blog-title">{{ $blog->title }}</h1>
    <p><img id="blog-img" class='lightbox' src="{{asset('uploads').'/'.$blog->imageUrl }}" > </p>
    <p>Author-:<span class="author-name">{{ $blog->user("name")->first()->name }}</span></p>
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
            {{ Form::submit('Leave a comment',['class'=>'btn']) }}

            {{Form::close() }}
        </div>

        <h2>Comments</h2>

        <?php
        $comments = $blog->comments()->get();
        ?> 
        <p> <?= count($comments); ?> comments</p>
        <?php
        foreach ($comments as $comment) {
            ?>
            <div class="tweet">
                <div class="tweet-header">  
                    <img id="comment-img" src="{{ $comment->user()->first()->imageUrl }}" alt="">
                    <span class="created-by">{{ $comment->user()->first()->name }}</span>
                    <span class="created_at">
                        {{$comment['created_at'] }}
                    </span>
                </div>
                <div class="tweet-body">
                    <p class="tweet-desc">
                        {{($comment['description'])}}
                    </p>
                    <span class="favourites">
                        {{ $comment['likes'] }} favorites
                    </span>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

@stop