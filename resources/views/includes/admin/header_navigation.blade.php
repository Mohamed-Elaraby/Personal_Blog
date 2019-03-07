<nav class="navbar page-header">
    <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
        <i class="fa fa-bars"></i>
    </a>

    <a class="navbar-brand" href="/">
        {{--<img src="{{ asset('admin/assets/imgs/logo.png') }}" alt="logo">--}}
        <p><strong>P</strong>ersonal <strong>B</strong>log</p>
    </a>

    <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
        <i class="fa fa-bars"></i>
    </a>

    <ul class="navbar-nav ml-auto">

        {{-- Notifications Icon--}}

        {{--<li class="nav-item d-md-down-none">--}}
            {{--<a href="#">--}}
                {{--<i class="fa fa-bell"></i>--}}
                {{--<span class="badge badge-pill badge-danger">5</span>--}}
            {{--</a>--}}
        {{--</li>--}}

        {{--<li class="nav-item d-md-down-none">--}}
            {{--<a href="#">--}}
                {{--<i class="fa fa-envelope-open"></i>--}}
                {{--<span class="badge badge-pill badge-danger">5</span>--}}
            {{--</a>--}}
        {{--</li>--}}

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('admin/assets/imgs/avatar-1.png') }}" class="avatar avatar-sm" alt="logo">
                <span class="small ml-1 d-md-down-none">{{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">

                <a href="{{ route('user.profile') }}" class="dropdown-item">
                    <i class="fa fa-user"></i> Profile
                </a>

                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('form_logout').submit();">
                    <i class="fa fa-lock"></i> Logout
                </a>
                <form id="form_logout" action="{{ route('logout') }}" method="post">@csrf</form>
            </div>
        </li>
    </ul>
</nav>