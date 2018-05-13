@extends('__layout.layout')


@section('content')
    {{ $user }}
    <hr>

    <div>
        <p>名字：{{ $user->name }}</p>
        <p>账号：{{ $user->email }}</p>
        <p>头像：<img src="{{ $user->avatar }}" alt=""></p>
        <p>性别：{{ $user->gender }}</p>
        <p>生日：{{ $user->birthday }}</p>
        <p>所在城市：{{ $user->reside_city }}</p>
        <p>一句话简介：{{ $user->bio }}</p>
        <p>可改名：{{ $user->is_rename }}</p>
    </div>
@endsection