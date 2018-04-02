@extends('__layout.layout')


@section('content')
    @parent
    <br>
    @{{ message }}
    <br>
    <button id="" onclick="test123()">alert123</button>
    <button id="" onclick="test456()">alert456</button>
    <button id="" onclick="test789()">alert789</button>

@endsection