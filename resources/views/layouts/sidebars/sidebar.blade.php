<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Site
    </div>




    <li class="nav-item @yield('classes')">
        <a class="nav-link" href="{{ route('admin.classes.index') }}">
            <i class="fas fa-home"></i>
            <span>Manage Classes</span></a>
    </li>
    <li class="nav-item @yield('jobs')">
        <a class="nav-link" href="{{ route('admin.job-blog.index') }}">
            <i class="fas fa-blog"></i>
            <span>Jobs Posts</span></a>
    </li>
    <li class="nav-item @yield('settings')">
        <a class="nav-link" href="{{ route('settings.index') }}">
            <i class="fas fa-cog"></i>
            <span>Settings</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
