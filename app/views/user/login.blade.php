@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>User Login</h1>
    <hr>
    {{ Form::open() }}
    <div class="input-wrap">
        {{Form::text('email','',array('placeholder'=>'Email','class'=>'input')) }}
        
    </div>
    <div class="input-wrap">
        {{Form::password('password',array('placeholder'=>'Password','class'=>'input')) }}
    </div> <br>
    {{ Form::submit('Login',['class'=>'btn']) }}
    {{Form::close() }}
    <hr>
    <div>
        <h3>OR Login With</h3>
        {{ link_to("user/loginwith/Facebook","Facebook") }} <br>
        {{ link_to("user/loginwith/Google","Google") }} <br>
        {{ link_to("user/loginwith/Twitter","Twitter") }}<br>
        {{ link_to("user/loginwith/LinkedIn","LinkedIn") }} <br>
    </div>
    <div>
        <h3>
            @if(isset($error)) {{ $error }} 
            {{ $error; }}
            @endif
        </h3>
    </div>

</div>

@stop