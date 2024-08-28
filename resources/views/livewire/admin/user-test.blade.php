<div class="col-md-12 row justify-content-between">
    <div class="card col-md-7">
        <div class="card-header">
            <h3 class="card-title">مشاهده نتیجه آزمون</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <th>آزمون</th>
                    <td>{{$user_test->test?->name}}</td>
                </tr>
                <tr>
                    <th>تعداد سوالات پاسخ داده شده</th>
                    <td>
                        {{$user_test->choices?->where('answer')->count()}}
                        از
                        {{$user_test->choices?->count()}}
                    </td>
                </tr>
                <tr>
                    <th>تعداد سوالات صحیح</th>
                    <td>{{$user_test->choices?->where('isCorrect')->count()}}</td>
                </tr>
                <tr>
                    <th>تعداد سوالات غلط</th>
                    <td>{{$user_test->choices?->where('answer')->where('isCorrect',0)->count()}}</td>
                </tr>
                <tr>
                    <th>تعداد سوالات پاسخ داده نشده</th>
                    <td>{{$user_test->choices?->where('answer',null)->count()}}</td>
                </tr>
                <tr>
                    <th>در صد</th>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"
                                 style="width: {{(($user_test->choices?->where('isCorrect')->count() * 100) / $user_test->test?->number_of_question)}}%"
                                 aria-valuenow="{{(($user_test->choices?->where('isCorrect')->count() * 100) / $user_test->test?->number_of_question)}}"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        {{(($user_test->choices?->where('isCorrect')->count() * 100) / $user_test->test?->number_of_question)}} %
                    </td>
                </tr>
                </tbody>
            </table>
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
    @if ($user_test->test?->show_answers)
        <div class="card col-md-12">
            <div class="card-header">
                <h3 class="card-title">سوالات</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>سوال</th>
                        <th>گزینه ها</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_test->choices as $choice)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$choice->question->question}}</td>
                            <td class="{{$choice->answer ? ($choice->isCorrect ? 'bg-light-success' : 'bg-light-danger') : ''}}">
                                <div class="form-check">
                                    <input class="form-check-input" {{$choice->answer === 1 ? 'checked' : ''}}
                                    type="radio"
                                           name="choices{{$loop->index}}" id="choice1{{$loop->index}}" value="1">
                                    <label class="form-check-label" for="choice1{{$loop->index}}">
                                        @if($choice->question->answer === 1)
                                            <i class="fa-light fa-check"></i>
                                        @endif
                                        {{$choice->question->choice1}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{$choice->answer === 2 ? 'checked' : ''}}
                                    type="radio" name="choices{{$loop->index}}" id="choice2{{$loop->index}}"
                                           value="2">
                                    <label class="form-check-label" for="choice2{{$loop->index}}">
                                        @if($choice->question->answer === 2)
                                            <i class="fa-light fa-check"></i>
                                        @endif
                                        {{$choice->question->choice2}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{$choice->answer === 3 ? 'checked' : ''}}
                                    type="radio" name="choices{{$loop->index}}" id="choice3{{$loop->index}}"
                                           value="3">
                                    <label class="form-check-label" for="choice3{{$loop->index}}">
                                        @if($choice->question->answer === 3)
                                            <i class="fa-light fa-check"></i>
                                        @endif
                                        {{$choice->question->choice3}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{$choice->answer === 4 ? 'checked' : ''}}
                                    type="radio" name="choices{{$loop->index}}" id="choice4{{$loop->index}}"
                                           value="4">
                                    <label class="form-check-label" for="choice4{{$loop->index}}">
                                        @if($choice->question->answer === 4)
                                            <i class="fa-light fa-check"></i>
                                        @endif
                                        {{$choice->question->choice4}}
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
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
