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

    <div class="card">
        <div class="card-header">{{ __('Verify Your Email Address') }}</div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>

</div>

<script src="{{'https://cdn.queensherainfotech.com/panel/plugins/jquery/jquery.min.js'}}"></script>

<script src="{{'https://cdn.queensherainfotech.com/panel/plugins/bootstrap/js/bootstrap.bundle.min.js'}}"></script>

<script src="{{'https://cdn.queensherainfotech.com/panel/dist/js/adminlte.min.js'}}"></script>
</body>
</html>
