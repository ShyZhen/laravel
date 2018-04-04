@extends('__layout.layout')

@section('title', 'Page Title 标题')

@section('sidebar')
    @parent   {{-- 输出父级，追加内容，不使用该命令则覆盖父级 --}}
    <p>子侧边栏</p>
@endsection

@section('content')
    @parent
    <p>content 子 {{ $name }}   <?php //echo $name ?></p> <br>   {{--xss攻击案例 laravel的模板语法会自动调用htmlentities过滤xss攻击--}}

    {{ $name or '默认名字（三元运算）' }}

    <br>

    {{ var_dump(Auth::check()) }}   {{--/attempt 登录返回true；  /logout 注销返回false--}}
@endsection