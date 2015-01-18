@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>Welcome To Mineblogs </h1>
    <!--<a href="{{ Request::url() }}/user" title="Laravel PHP Framework">Login</a>-->
    {{ link_to("/user/login","Login") }}
    {{ link_to("/user/register","Signup") }}
</div>

@stop