@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>User Registration</h1>
    <hr>
    {{ Form::open(['route' => ['user.store'], 'method' => 'post','files'=>true]) }}
    <div class="input-wrap">
        {{Form::text('email','',array('placeholder'=>'Email','class'=>'input')) }}
    </div>
    <div class="input-wrap">
        {{Form::password('password',array('placeholder'=>'Password','class'=>'input')) }}
    </div>
     <div class="input-wrap">
        {{Form::password('password_confirmation',array('placeholder'=>'Confirm Password','class'=>'input')) }}
    </div>
    <div class="input-wrap">
        {{Form::text('name','',array('placeholder'=>'Username','class'=>'input')) }}
    </div>
    <div class="input-wrap">
        {{Form::text('city','',array('placeholder'=>'City','class'=>'input')) }}
    </div>
    <div class="input-wrap">
    {{Form::text('country','',array('placeholder'=>'Country','class'=>'input')) }}
    </div>
    <br>
    {{ Form::submit('Register',['class'=>"btn"]) }}
    {{Form::close() }}

    <div>
        <h3>
            @if(isset($error)) {{ $error }} 
            {{ $error; }}
            @endif
        </h3>
    </div>
</div>

@stop

