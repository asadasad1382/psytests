<!-- BEGIN: Main Menu-->
@if (\Illuminate\Support\Facades\Auth::guard('admin')->check())
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
                <li class="nav-item {{url()->current() === route('admin.dashboard') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.dashboard')}}">
                        <i class="fa-light fa-home"></i>
                        <span class="menu-title text-truncate">داشبورد</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('admin.categories') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.categories')}}">
                        <i class="fa-light fa-list"></i>
                        <span class="menu-title text-truncate">دسته ها</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('admin.tests') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.tests')}}">
                        <i class="fa-light fa-book"></i>
                        <span class="menu-title text-truncate">مدیریت آزمون ها</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('admin.users_tests') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.users_tests')}}">
                        <i class="fa-light fa-exchange"></i>
                        <span class="menu-title text-truncate">آزمون های کاربران</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('admin.questions') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.questions')}}">
                        <i class="fa-light fa-question-circle"></i>
                        <span class="menu-title text-truncate">مدیریت سوالات</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('admin.users') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.users')}}">
                        <i class="fa-light fa-users"></i>
                        <span class="menu-title text-truncate">مدیریت کاربران</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('admin.admins') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.admins')}}">
                        <i class="fa-light fa-user-police"></i>
                        <span class="menu-title text-truncate">مدیریت مدیران</span>
                    </a>
                </li>

                <li class="nav-item {{url()->current() === route('admin.settings') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.settings')}}">
                        <i class="fa-light fa-gears"></i>
                        <span class="menu-title text-truncate">تنظیمات</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endif
<!-- END: Main Menu-->
