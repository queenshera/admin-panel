<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{'#'}}" class="nav-link">{{config('app.name')}}</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{auth()->user()->photo??\Illuminate\Support\Facades\Session::get('photo')}}" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-info">
                    <img src="{{auth()->user()->photo}}" class="img-circle elevation-2" alt="User Image">
                    <p>
                        {{auth()->user()->name}}
                        <small>{{auth()->user()->email}}</small>
                        <small>{{auth()->user()->mobile}}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{route('logout')}}" class="btn btn-default btn-flat float-right">
                        Sign out
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

