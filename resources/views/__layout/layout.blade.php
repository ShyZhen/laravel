<!doctype html>
<html lang="zh-CN">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    {{--默认集成bootcss和vue脚手架--}}
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">
    <script src="{{elixir('js/app.js')}}"></script>
</head>
<body>
<div id="main" class="main">

    <div id="sidebar" class="sidebar">
        @section('sidebar')
            layout sidebar
        @show
    </div>

    <div id="container" class="container">
       {{--@yield('content')--}}    {{--  占位符，@section完全覆盖  --}}
        @section('content')        {{--  @section完全覆盖，如果有@parent则是追加  --}}
            layout content
        @show
    </div>

    <div id="footer" class="footer">
        @section('footer')
            layout footer
        @show
    </div>
</div>
</body>
</html>