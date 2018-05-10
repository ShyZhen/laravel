@extends('__layout.layout')


@section('content')
    {{ $user }}
    <hr>

    <div>
        <p>{{ $user->name }}</p>
        <p>{{ $user->email }}</p>
        <p><img src="{{ $user->avatar }}" alt=""></p>
    </div>
@endsection