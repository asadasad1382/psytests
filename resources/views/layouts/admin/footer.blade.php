<!-- Footer -->
</div>

</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="/admin/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/admin/app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="/admin/app-assets/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/admin/app-assets/js/core/app-menu.min.js"></script>
<script src="/admin/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{--<script src="/admin/app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>--}}
<script src="/admin/app-assets/js/scripts/pages/dashboard-analytics.js"></script>

<!-- END: Page JS-->

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({width: 14, height: 14});
        }
    })
</script>
@yield('scripts')
@yield('extraJs')
</body>
<!-- END: Body-->
</html>
