<html>
<head>
    <title></title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <form action="{{url('/valida/post/create')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-md-12">
            <input type="text" name="name" placeholder="name">
        </div>
        <div>
            <input type="text" name="email" placeholder="emali">
        </div>
        <div>
            <input type="password" name="password" placeholder="password">
        </div>

        <input type="submit" class="btn btn-primary" value="提交">
    </form>
</div>

</body>
</html>