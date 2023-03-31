<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('/')}}" class="brand-link">
        <img src="{{'https://cdn.queensherainfotech.com/panel/dist/img/AdminLTELogo.png'}}" alt="{{config('app.name')}} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->photo}}" class="img-circle elevation-2 text-white-50" alt="Photo">
            </div>
            <div class="info">
                <a href="{{route('profile',['redirect'=>\Illuminate\Support\Facades\URL::current()])}}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="fa fa-sign-out-alt nav-icon"></i> <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
