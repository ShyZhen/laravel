@extends('__layout.layout')

@section('content')
<div class="content">

    <div class="col-lg-6">
        <form>
            <div class="form-group">
                <label for="username">用户名:</label>
                <input type="text" id="username" class="form-control" v-model="accoutUsername" placeholder="username" required>
            </div>
            <div class="form-group">
                <label for="password">密码:</label>
                <input type="password" id="password" class="form-control" v-model="accoutPassword" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default" v-on:click.prevent="userLogin">Submit</button>
            </div>
        </form>
    </div>

</div>
@endsection