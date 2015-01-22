@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>Update Password</h1>
    <hr>
    {{ Form::open(['url' => ['user/change_password'], 'method' => 'post']) }}
    <div class="input-wrap">
         {{Form::password('old_password',array('placeholder'=>'Old Password','class'=>'input')) }}
    </div>
    <div class="input-wrap">
         {{Form::password('password',array('placeholder'=>'New-Password','class'=>'input')) }}
    </div>
    <div class="input-wrap">
        {{Form::password('password_confirmation',array('placeholder'=>'Confirm New-Password','class'=>'input')) }}
    </div> <br>
    {{ Form::submit('Save',['class'=>'btn']) }}
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