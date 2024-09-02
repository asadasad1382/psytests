<!-- BEGIN: Main Menu-->
@if (\Illuminate\Support\Facades\Auth::check())
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{route('panel.dashboard')}}">
                    <span class="brand-logo">
                </span>
                        <h2 class="brand-text">{{Setting::get('title')}}</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x">
                        </i>
                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                           data-feather="disc"
                           data-ticon="disc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item {{url()->current() === route('panel.dashboard') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('panel.dashboard')}}">
                        <i class="fa-light fa-home"></i>
                        <span class="menu-title text-truncate">داشبورد</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('panel.categories') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('panel.categories')}}">
                        <i class="fa-light fa-list"></i>
                        <span class="menu-title text-truncate">شروع آزمون</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('panel.user_tests') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('panel.user_tests')}}">
                        <i class="fa-light fa-chart-area"></i>
                        <span class="menu-title text-truncate">نتایج آزمون</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endif
<!-- END: Main Menu-->
