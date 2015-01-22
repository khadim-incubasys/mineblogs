@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>Create Blog</h1>
    <hr>
    {{ Form::open(['route' => ['blog.store'], 'method' => 'post','files'=>true]) }}
    <div class="input-wrap">
        {{Form::text('title',Input::old('title'),  array('placeholder'=>'Blog Title','class'=>'input-title')) }}
    </div>
    <div>
        <br>
        {{Form::textarea('body',Input::old('body'),  array('placeholder'=>'Write your Blog','class'=>'create-blog')) }}
    </div>
    <div>
        {{ Form::label('images',"Choose Image") }}
        {{ Form::file('file','',array('id'=>'fileId','class'=>'file')) }}
    </div>
    <br>
    {{ Form::submit('Create',['class'=>'btn']) }}
    {{Form::close() }}
    <hr>
    {{ link_to("user","Cancel") }} <br>

    <div>
        <h3>
            @if(isset($error)) {{ $error }} 
            @endif
        </h3>
    </div>
</div>

@stop