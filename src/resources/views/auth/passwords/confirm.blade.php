<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{'https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css'}}">

    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css'}}">

    <link rel="stylesheet" href="{{'https://cdn.queensherainfotech.com/panel/dist/css/adminlte.min.css?v=3.2.0'}}">
<body class="hold-transition lockscreen">

<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="{{route('/')}}">{{config('app.name')}}</a>
    </div>
    @error('password')
    <div class="alert alert-warning">
        {{ $message }}
    </div>
    @enderror

    <div class="lockscreen-name">{{auth()->user()->name}}</div>

    <div class="lockscreen-item">
        <div class="lockscreen-image">
            <img src="{{auth()->user()->photo}}" alt="User Image">
        </div>

        <form method="post" action="{{route('password.confirm')}}" class="lockscreen-credentials">
            <div class="input-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" required>
                <div class="input-group-append">
                    @csrf
                    <button type="submit" class="btn">
                        <i class="fas fa-arrow-right text-muted"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>

    <div class="help-block text-center">
        Enter your password again to confirm
    </div>
    <div class="text-center">
        <a href="{{route('logout')}}">Or sign in as a different user</a>
    </div>
</div>


<script src="{{'https://cdn.queensherainfotech.com/panel/plugins/jquery/jquery.min.js'}}"></script>

<script src="{{'https://cdn.queensherainfotech.com/panel/plugins/bootstrap/js/bootstrap.bundle.min.js'}}"></script>

<script src="{{'https://cdn.queensherainfotech.com/panel/dist/js/adminlte.min.js'}}"></script>
</body>
</html>
