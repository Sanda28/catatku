<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Catatku</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @php
        $allowed = ['admin', 'owner'];
    @endphp
    @if(Auth::check() && in_array(Auth::user()->role, $allowed))
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>
    <li class="nav-item active">
        <li class="nav-item">
            <a class="nav-link pb-0" href="/mobil">
                <i class="fa fa-fw fa-car"></i>
                <span>Mobil</span></a>
        </li>
        @if(Auth::check() && Auth::user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link pb-0" href="/user">
                <i class="fa fa-fw fa-users"></i>
                <span>User</span></a>
        </li>
        @endif
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
    @endif
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Transaksi
    </div>
    <li class="nav-item active">
        <li class="nav-item">
            <a class="nav-link pb-0" href="/bukukas">
                <i class="fa fa-fw fa-book"></i>
                <span>Buku Kas</span></a>
        </li>
    </li>

    @if(Auth::check() && in_array(Auth::user()->role, $allowed))
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>
    <li class="nav-item active">
        <!--<li class="nav-item">
            <a class="nav-link pb-0" href="">
                <i class="fa fa-fw fa-file"></i>
                <span>Laporan Harian</span></a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link pb-0" href="{{ route('laporan.index') }}">
                <i class="fa fa-fw fa-file"></i>
                <span>Laporan Bulanan</span></a>
        </li>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
