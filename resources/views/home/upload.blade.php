<html>
<head>
    <title></title>
</head>
<body>
<div>
    <form action="{{url('route/upload')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}
    <input type="file" name="filetxt">
    <input type="file" name="fileimg">
    <input type="submit" value="提交">
    </form>
</div>
</body>
</html>