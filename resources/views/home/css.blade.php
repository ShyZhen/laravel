@extends('__layout.layout')


@section('content')
    @parent
    <br>
    @{{ message }}
    <br>
    <button id="test" onclick="test123()">alert123</button>
    <button id="" onclick="test456()">alert456</button>

@endsection