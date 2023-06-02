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

</head>
<body class="hold-transition login-page">
<div class="login-box" >
    <div class="login-logo">
        <a href="{{route('/')}}">{{config('app.name')}}</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg p-0">
                Please confirm access to your account by entering one of your emergency recovery codes.
            </p>
            <form action="{{route('login.2fa.recovery')}}" method="post">
                <div class="card-body login-card-body">
                    <div class="form-group mb-3">
                        <label for="recoveryCode">Recovery Code</label>
                        <input type="text" id="recoveryCode" name="recoveryCode" class="form-control" required autofocus>
                        @if(session('error'))<p style="color: red">{{session('error')}}</p>@endif
                    </div>

                </div>
                <div class="card-footer">
                    <a href="{{route('two-factor-challenge')}}">Use an authentication code</a>
                    @csrf
                    <button class="btn btn-secondary float-right">Verify</button>
                </div>
            </form>
        </div>

    </div>
</div>


<script src="{{'https://cdn.queensherainfotech.com/panel/plugins/jquery/jquery.min.js'}}"></script>

<script src="{{'https://cdn.queensherainfotech.com/panel/plugins/bootstrap/js/bootstrap.bundle.min.js'}}"></script>

<script src="{{'https://cdn.queensherainfotech.com/panel/dist/js/adminlte.min.js'}}"></script>
</body>
</html>
