@extends('layouts.default')
@section('content')

<div class="welcome">
    <h1>User Information</h1>
    <p><img src="{{$user->imageUrl }}" > </p>
    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Status: {{ $user->status }}</p>
    <p>City: {{ $user->city }}</p>
    <p>Country: {{ $user->country }}</p>
    <div>
        {{ link_to("user/1/edit","Edit") }}
    </div>
</div>
@stop
