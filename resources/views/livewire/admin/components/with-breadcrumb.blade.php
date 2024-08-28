@section('title','| '.$breadcrumb['title'])
@section('scripts')
    <script>
        window.addEventListener("DOMContentLoaded", function () {
            @this.
            loadBreadcrumb()
        });
    </script>
@endsection
