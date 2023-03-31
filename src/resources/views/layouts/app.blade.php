<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.metadata')

    <title>{{config('app.name')}}</title>

    @include('layouts.styles')
    @yield('custom-styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed pace-primary">
<div class="wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                @yield('content-header')
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @yield('content-body')
            </div>
        </section>
    </div>

    @include('layouts.footer')
</div>

@include('layouts.scripts')

@yield('custom-scripts')
</body>
</html>
