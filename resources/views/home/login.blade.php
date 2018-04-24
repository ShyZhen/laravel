@extends('__layout.layout')

@section('content')
<div class="content">

    <div class="col-lg-6">
        <form class="form-horizontal" role="form" method="POST">

            <div class="form-group">
                <label for="email">邮箱:</label>
                <input type="email" id="email" class="form-control" v-model="accoutUsername" value="{{ old('email') }}" placeholder="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">密码:</label>
                <input type="password" id="password" class="form-control" v-model="accoutPassword" placeholder="Password" required>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="accoutRemember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default" v-on:click.prevent="userLogin">Submit</button>
            </div>
        </form>
    </div>

</div>
@endsection