@extends('__layout.layout')

@section('title', '评论页')


@section('sidebar')
@endsection

@section('content')

    @include('__layout.flashmessage')
    @foreach($comments as $key => $val)
        {{$val['username']}}
        <h1>{{$val['comment']}}</h1>
        @if(count($val['son']) > 0)
            @foreach($val['son'] as $sonA)
                {{$sonA['username']}}
                <h2>{{ ($sonA['comment']) }}</h2>
            @endforeach
        @endif
    @endforeach

@endsection

