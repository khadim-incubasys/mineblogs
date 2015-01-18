@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>User Registration</h1>
    <hr>
    {{ Form::open() }}
    <div>
        {{Form::label('email','Email Adr') }}
        {{Form::text('email') }}
    </div>
    <div>
        {{Form::label('password','Password') }}
        {{Form::password('password') }}
    </div>
    <div>
        {{Form::label('name','User Name') }}
        {{Form::text('name') }}
    </div>
    <br>
    {{ Form::submit('Login') }}
    {{Form::close() }}
</div>

@stop