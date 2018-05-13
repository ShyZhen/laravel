<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" id="csrfToken" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">
</head>
<body>
@include('__layout.flashmessage')
<div id="main" class="main" v-cloak>

    @include('__layout.header')

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
<script src="{{elixir('js/app.js')}}"></script>

<script>
    {{--flash提示框自动消失,--}}
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>

{!! Toastr::render() !!}
@yield('js')

</body>
</html>