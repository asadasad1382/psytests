<div class="col-md-12 row justify-content-between">
    <div class="card col-md-7">
        <div class="card-header">
            <h3 class="card-title">مشاهده نتیجه آزمون</h3>
        </div>
        <div class="card-body">
            <button wire:click="download">
                دانلود نتیجه آزمون
            </button>
        </div>
    </div>
    <div class="card col-md-4">
        <div class="card-header">
            <h3 class="card-title">چارت</h3>
        </div>
        <div class="card-body">
            <canvas id="chart"></canvas>
        </div>
    </div>
</div>
@include('livewire.admin.components.with-breadcrumb')
@section('extraJs')
    <script src="/admin/app-assets/vendors/js/charts/chart.min.js"></script>

    <script>
        // Pie Chart
        // --------------------------------
        var $primary = '#7367F0';
        var $success = '#28C76F';
        var $danger = '#EA5455';
        var $warning = '#FF9F43';
        var $label_color = '#1E1E1E';
        var grid_line_color = '#dae1e7';
        var scatter_grid_color = '#f3f3f3';
        var $scatter_point_light = '#D1D4DB';
        var $scatter_point_dark = '#5175E0';
        var $white = '#fff';
        var $black = '#000';

        var themeColors = [$primary, $success, $danger, $warning, $label_color];

        //Get the context of the Chart canvas element we want to select
        var pieChartctx = $("#chart");

        // Chart Options
        var piechartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            responsiveAnimationDuration: 500,
            title: {
                display: true,
                text: 'نتیجه آزمون'
            }
        };

        // Chart Data
        var piechartData = {
            labels: ["تعداد کل سوالات", "پاسخ صحیح", "پاسخ غلط", "بدون پاسخ"],
            datasets: [{
                label: "نتیجه آزمون",
                data: [
                    {{$user_test->choices?->count()}},
                    {{$user_test->choices?->where('answer')->where('isCorrect')->count()}},
                    {{$user_test->choices?->where('answer')->where('isCorrect',0)->count()}},
                    {{$user_test->choices?->where('answer',null)->count()}}
                ],
                backgroundColor: themeColors,
            }]
        };

        var pieChartconfig = {
            type: 'pie',

            // Chart Options
            options: piechartOptions,

            data: piechartData
        };

        // Create the chart
        var pieSimpleChart = new Chart(pieChartctx, pieChartconfig);
    </script>
@endsection
