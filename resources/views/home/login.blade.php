@extends('__layout.layout')

@section('content')
<div class="content">
    <form action="">
        <div class="form-group">
            <label for="username">用户名:</label>
            <input type="text" id="username" class="form-control" v-model="accoutUsername" placeholder="username" required="required">
        </div>
        <div class="form-group">
            <label for="password">密码:</label>
            <input type="password" id="password" class="form-control" v-model="accoutPassword" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default" v-on:click="userLogin">Submit</button>
        </div>
    </form>
</div>
@endsection