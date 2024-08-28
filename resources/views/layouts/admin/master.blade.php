@include('layouts.admin.header')
@include('layouts.admin.sidebar')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                @if (\Illuminate\Support\Facades\Auth::guard('admin')->check())
                    @livewire('admin.components.breadcrumb')
                @endif
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    @yield('main')
                </div>
            </div><!-- Dashboard Ecommerce Starts -->
        </div>
    </div>
</div>
@include('layouts.admin.footer')
