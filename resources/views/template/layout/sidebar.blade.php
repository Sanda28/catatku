<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">Catatku</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="/dashboard" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>DashBoard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#master" aria-expanded="false" aria-controls="master">
                <i class="lni lni-protection"></i>
                <span>Data Master</span>
            </a>
            <ul id="master" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="/mobil" class="sidebar-link">Mobil</a>
                </li>
                <li class="sidebar-item">
                    <a href="/user" class="sidebar-link">User</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#transaksi" aria-expanded="false" aria-controls="transaksi">
                <i class="lni lni-protection"></i>
                <span>Data Transaksi</span>
            </a>
            <ul id="transaksi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="/bukukas" class="sidebar-link">Buku Kas</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#profil" aria-expanded="false" aria-controls="profil">
                <i class="lni lni-protection"></i>
                <span>Profil</span>
            </a>
            <ul id="profil" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="/profil" class="sidebar-link">Profil</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('profil.changePasswordForm') }}" class="sidebar-link">Ganti Password</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#laporan" aria-expanded="false" aria-controls="laporan">
                <i class="lni lni-protection"></i>
                <span>Laporan</span>
            </a>
            <ul id="laporan" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="/laporan" class="sidebar-link">Laporan Bulanan</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidebar-footer">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
