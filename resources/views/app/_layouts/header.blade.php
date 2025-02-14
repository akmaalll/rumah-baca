<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: HEADER -->
<header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
    <div class="c-navbar">
        <div class="container">
            <!-- BEGIN: BRAND -->
            <div class="c-navbar-wrapper clearfix">
                <div class="c-brand c-pull-left">
                    <a href="index.html" class="c-logo">
                        <img src="{{ asset('logo.png') }}" width="80px" alt="JANGO" class="c-desktop-logo">
                        <img src="{{ asset('logo.png') }}" width="50px" alt="JANGO" class="c-desktop-logo-inverse">
                        <img src="{{ asset('logo.png') }}" alt="JANGO" class="c-mobile-logo">
                    </a>
                    <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                        <span class="c-line"></span>
                    </button>
                    <button class="c-topbar-toggler" type="button">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <button class="c-search-toggler" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="c-cart-toggler" type="button">
                        <i class="icon-handbag"></i> <span class="c-cart-number c-theme-bg">2</span>
                    </button>
                </div>
                <!-- END: BRAND -->
                <!-- BEGIN: QUICK SEARCH -->
                <form class="c-quick-search" action="#">
                    <input type="text" name="query" placeholder="Type to search..." value=""
                        class="form-control" autocomplete="off">
                    <span class="c-theme-link">&times;</span>
                </form>
                <!-- END: QUICK SEARCH -->
                <!-- BEGIN: HOR NAV -->
                <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- BEGIN: MEGA MENU -->
                <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
                <nav
                    class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
                    <ul class="nav navbar-nav c-theme-nav">
                        <li>
                            <a href="" class="c-link dropdown-toggle">Beranda<span
                                    class="c-arrow c-toggler"></span></a>
                        </li>
                        <li>
                            <a href="{{ route('user.rekomendasi.index') }}"
                                class="c-link dropdown-toggle">Rekomendasi<span class="c-arrow c-toggler"></span></a>
                        </li>
                        @if (!Auth::check())
                            <li>
                                <a href="{{ route('login') }}" class="c-link dropdown-toggle">Login<span
                                        class="c-arrow c-toggler"></span></a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('logout') }}" class="c-link dropdown-toggle">Logout<span
                                        class="c-arrow c-toggler"></span></a>
                            </li>
                        @endif

                    </ul>
                </nav>
                <!-- END: MEGA MENU --><!-- END: LAYOUT/HEADERS/MEGA-MENU -->
                <!-- END: HOR NAV -->
            </div>
        </div>
    </div>
</header>
<!-- END: HEADER --><!-- END: LAYOUT/HEADERS/HEADER-1 -->
