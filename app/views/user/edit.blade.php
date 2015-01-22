@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>Update Information</h1>
    <hr>
    {{ Form::open(['route' => ['user.update', $user->id], 'method' => 'put']) }}
    <div class="input-wrap">
        {{Form::text('name',$user->name,['class'=>'input','placeholder'=>"Username"]) }}
    </div>
    <div class="input-wrap">
        {{Form::text('city',$user->city,['class'=>'input','placeholder'=>"City"]) }}
    </div>
    <div class="input-wrap">
        {{Form::text('country',$user->country,['class'=>'input','placeholder'=>"Country"]) }}
    </div>
    <br>
    {{ Form::submit('Save',['class'=>'btn']) }}
    {{Form::close() }}
    <hr>

    <div>
        <h3>
            @if(isset($error)) {{ $error }} 
            {{ $error; }}
            @endif
        </h3>
    </div>
</div>

@stop