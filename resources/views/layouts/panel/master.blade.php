@include('layouts.panel.header')
@include('layouts.panel.sidebar')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <script type="text/javascript">
        !function(){var i="mwXQS3",a=window,d=document;function g(){var g=d.createElement("script"),s="https://www.goftino.com/widget/"+i,l=localStorage.getItem("goftino_"+i);g.async=!0,g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}"complete"===d.readyState?g():a.attachEvent?a.attachEvent("onload",g):a.addEventListener("load",g,!1);}();
    </script>
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                @if (\Illuminate\Support\Facades\Auth::check())
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
@include('layouts.panel.footer')
