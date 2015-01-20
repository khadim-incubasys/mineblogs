@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>Update Information</h1>
    <hr>
    {{ Form::open(['route' => ['user.update', $user->id], 'method' => 'put']) }}
    <div>
        {{Form::label('name','User Name') }}
        {{Form::text('name',$user->name) }}
    </div>
    <div>
        {{Form::label('city','City Name') }}
        {{Form::text('city',$user->city) }}
    </div>
    <div>
        {{Form::label('country','Country') }}
        {{Form::text('country',$user->country) }}
    </div>
    <br>
    {{ Form::submit('Save') }}
    {{Form::close() }}
    <hr>
    {{ link_to("user","Home") }} <br>

    <div>
        <h3>
            @if(isset($error)) {{ $error }} 
            {{ $error; }}
            @endif
        </h3>
    </div>
</div>

@stop