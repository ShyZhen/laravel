@extends('__layout.layout')

@section('content')
    {{--提示插件放在一个文件里需要则引用--}}
    {{--lara/flashmessage消息提示--}}
    @include('__layout/flashmessage')

    {{-- Toastr消息提示 --}}
    {!! Toastr::render() !!}
    {{ $a }}
    {{ $b }}
    {{ $shareValue1 }}
    {{ $shareValue2 }}
    {{ $compose }}
@endsection