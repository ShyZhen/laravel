<html>
<head>
    <title></title>
</head>
<body>
<div>
    {{--lara/flashmessage消息提示--}}
    @include('__layout/flashmessage')


    {{-- Toastr消息提示 --}}
    {!! Toastr::render() !!}



    {{ $a }}
    {{ $str }}
</div>
</body>
</html>