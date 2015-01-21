@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>Create Comment</h1>
    <hr>
    {{ Form::open(['route' => ['comment.store'], 'method' => 'post','files'=>true]) }}
    <div>
        {{Form::textarea('description',Input::old('description'),  array('placeholder'=>'Write your comment')) }}
        {{Form::hidden('blog_id',$blog_id) }}
        
    </div>
    <div>
        {{ Form::label('file',"Choose Image") }}
        {{ Form::file('file','',array('id'=>'fileId','class'=>'file')) }}
    </div>
    <br>
    {{ Form::submit('Create',['class'=>'btn']) }}
    {{Form::close() }}
    <hr>
    {{ link_to("blog","Cancel") }} <br>

    <div>
        <h3>
            @if(isset($error)) {{ $error }} 
            @endif
        </h3>
    </div>
</div>

@stop