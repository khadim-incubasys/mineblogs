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
        {{ link_to("/user/loginwith/Facebook","Facebook Login") }} <br>
        {{ link_to("/user/loginwith/Google","Google Login") }}
    </div>
</div>



@stop