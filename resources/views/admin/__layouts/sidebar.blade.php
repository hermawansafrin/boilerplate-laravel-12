<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="{{ asset('') }}/logo.png" alt="{{ config('app.name') }} Logo" class="brand-image img-circle elevation-3 bg-white" style="opacity: 0.9">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-template') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name ?? 'Guest' }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($menus as $key => $menu)
                    <li class="nav-item {{ ($menu['permission'] == $isActive1) ? 'menu-open' : '' }}">
                        @if(!isset($menu['sub']))
                            <a href="{{ route($menu['route_name']) }}" class="nav-link {{ $isActive1 == $menu['permission'] ? 'active' : '' }}">
                                <i class="nav-icon {{ $menu['icon'] }}"></i>
                                <p>{{ $menu['title'] }}</p>
                            </a>
                        @else
                            <a href="#" class="nav-link {{ $isActive1 == $menu['permission'] ? 'active' : '' }}">
                                <i class="nav-icon {{ $menu['icon'] }}"></i>
                                <p>
                                    {{ $menu['title'] }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach($menu['sub'] as $subKey => $subMenu)
                                <li class="nav-item">
                                    <a href="{{ route($subMenu['route_name']) }}" class="nav-link {{ $isActive2 == $subMenu['permission'] ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $subMenu['title'] }}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
