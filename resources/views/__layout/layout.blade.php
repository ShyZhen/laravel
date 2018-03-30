<html>
<head>
    <title>@yield('title')</title>
    {{--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.js"></script>--}}

    {{--默认集成bootcss和vue脚手架--}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
    @section('sidebar')
        这里是侧边栏sidebar
    @show

    <div class="container">

       {{--@yield('content')--}}    {{--  占位符，@section完全覆盖  --}}

        @section('content')        {{--  @section完全覆盖，如果有@parent则是追加  --}}
            这里是内容content
        @show
    </div>
</body>
</html>