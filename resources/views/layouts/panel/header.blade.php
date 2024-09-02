<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="سامانه آزمون مرکز آکادمی آموزش ایرانیان برگزار کننده دوره های آموزشی با مدارک معتبر بین المللی از سراسر جهان با ریجستر آنلاین در سریعترین زمان">
    <meta name="keywords"
          content="سامانه آرمون آکادمی مجازی ایرانیان">
    <meta name="author" content="webazin.net">
    <title>{{Setting::get('title')}} @yield('title')</title>
    <link rel="apple-touch-icon" href="/admin/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/admin/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/colors.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/components.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/themes/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/themes/semi-dark-layout.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/pages/dashboard-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/plugins/charts/chart-apex.min.css">
    <link rel="stylesheet" type="text/css"
          href="/admin/app-assets/css-rtl/plugins/extensions/ext-component-toastr.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/custom-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/fonts/iranYekan/iranYekan.css">
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/fonts/fontawesome/all.min.css">
    <!-- END: Custom CSS-->
    @livewireStyles
    @livewireScripts
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
@if (\Illuminate\Support\Facades\Auth::check())
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
                                                                                     data-feather="menu"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link nav-link-style">
                            <i class="ficon" data-feather="sun"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                @livewire('admin.components.notifications')
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link"
                       id="dropdown-user" href="#" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none text-start">
                            <span
                                class="user-name fw-bolder">{{Auth::user()->name}}</span>
                            <span
                                class="user-status">کاربر</span>
                        </div>
                        <span class="avatar">
                        <img class="round"
                             src="{{Auth::user()->profile ? Storage::disk('public')->url(Auth::user()->profile->personal_photo) : '/admin/app-assets/images/portrait/small/avatar-s-11.jpg'}}"
                             alt="avatar"
                             height="40" width="40">
                        <span
                            class="avatar-status-online"></span>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{route('logout')}}">
                            <i
                                class="me-50 fa-light fa-power-off"></i>
                            خروج
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
@endif
<!-- END: Header-->
