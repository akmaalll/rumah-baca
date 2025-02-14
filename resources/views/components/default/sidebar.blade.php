<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
                {{-- <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard/general') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('dashboard.general') }}">General Dashboard</a></li>
                </ul> --}}
            </li>

            <li class="menu-header">Master</li>
            <li class="nav-item dropdown {{ $menu == 'buku' ? 'active' : '' }}">
                <a href="{{ route('buku.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Buku</span></a>
            </li>
            <li class="nav-item dropdown {{ $menu == 'kategori' ? 'active' : '' }}">
                <a href="{{ route('kategori.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Kategori Buku</span></a>
            </li>
            <li class="nav-item dropdown {{ $menu == 'clustering' ? 'active' : '' }}">
                <a href="{{ route('clustering.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                    <span>Clustering</span></a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Logout
            </a>
        </div>
    </aside>
</div>
