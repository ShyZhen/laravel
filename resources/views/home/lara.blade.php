<html>
<head>
    <title></title>
</head>
<body>
<div>
    {{--lara/flashmessage消息提示--}}
    @include('__layout/flashmessage')
    <form action="{{url('route/upload')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
        <input type="file" name="filetxt">
        <input type="file" name="fileimg">
        <input type="submit" value="提交">
    </form>

    {{-- Toastr消息提示 --}}
    {!! Toastr::render() !!}
</div>
</body>
</html>