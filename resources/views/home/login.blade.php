@extends('__layout.layout')

@section('content')
<div class="content">

        <div class="form-group">
            <label for="username">用户名:</label>
            <input type="text" id="username" class="form-control" placeholder="username">
        </div>
        <div class="form-group">
            <label for="password">密码:</label>
            <input type="password" id="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default" onclick="accountLogin()">Submit</button>
        </div>

</div>
@endsection