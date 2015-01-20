@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>User Login</h1>
    <hr>
    {{ Form::open() }}
    <div>
        {{Form::label('email','Email Adr') }}
        {{Form::text('email') }}
    </div>
    <div>
        {{Form::label('password','Password') }}
        {{Form::password('password') }}
    </div> <br>
    {{ Form::submit('Login') }}
    {{Form::close() }}
    <hr>
    <div>
        {{ link_to("user_loginwith/Facebook","Facebook") }} <br>
        {{ link_to("user_loginwith/Google","Google") }} <br>
        {{ link_to("user_loginwith/Twitter","Twitter") }}<br>
        {{ link_to("user_loginwith/LinkedIn","LinkedIn") }} <br>
    </div>
    <div>
        <h3>
            @if(isset($error)) {{ $error }} 
            {{ $error; }}
            @endif
        </h3>
    </div>
    <hr>
    {{ link_to("user/register","Signup") }} <br>
</div>
@stop