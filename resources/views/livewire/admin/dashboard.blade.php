<section id="dashboard-analytics">
    <div class="row match-height">
        <!-- Greetings Card starts -->
        <div class="col-lg-6 col-md-12 col-sm-12" wire:ignore>
            <div class="card card-congratulations">
                <div class="card-body text-center">
                    <img src="/admin/app-assets/images/elements/decore-left.png" class="congratulations-img-left"
                         alt="card-img-left"/>
                    <img src="/admin/app-assets/images/elements/decore-right.png" class="congratulations-img-right"
                         alt="card-img-right"/>
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content">
                            <i data-feather="award" class="font-large-1"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="mb-1 text-white">به پنل مدیریتی خوش آمدید</h1>
                        <p class="card-text m-auto w-75">
                            وب سایت خود را به آسانی مدیریت کنید!
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Greetings Card ends -->

        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12" wire:ignore>
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">{{$userCount}}</h2>
                    <p class="card-text">تعداد کاربران</p>
                </div>
                <div id="gained-chart"></div>
            </div>
        </div>
        <!-- Subscribers Chart Card ends -->

        <!-- Orders Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12" wire:ignore>
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="package" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">{{$testCount}}</h2>
                    <p class="card-text">تعداد آزمون ها</p>
                </div>
                <div id="order-chart"></div>
            </div>
        </div>
        <!-- Orders Chart Card ends -->
        @include('livewire.admin.components.with-breadcrumb')
    </div>
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">آخرین آزمون ها</h3>
                    <input type="text" wire:model="search" class="col-md-4 form-control form-control-sm rounded" placeholder="جستجو...">
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>نام کاربری</th>
                            <th>زمان آزمون</th>
                            <th>نام آزمون</th>
                            <th>ip</th>
                            <th>مدت پاسخ گویی</th>
                            <th>تعداد کل سوالات پاسخ داده شده</th>
                            <th>تعداد جواب های درست</th>
                            <th>تعداد جواب های نادرست</th>
                            <th>تعداد سوالات بی جواب</th>
                            <th>درصد</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($testUser as $test)
                            <tr>
                                <td>{{$test->user?->name}}</td>
                                <td>{{$test->user?->user_name}}</td>
                                <td>{{$test->created_at}}</td>
                                <td>{{$test->test?->name}}</td>
                                <td>{{$test->ip_address}}</td>
                                <td>{{$test->time_length}}</td>
                                <td>{{$test->choices->where('answer','!=',null)?->count()}}</td>
                                <td>{{$test->choices->where('is_correct',1)->count()}}</td>
                                <td>{{$test->choices->where('is_correct',0)->count()}}</td>
                                <td>{{$test->choices->where('answer',null)?->count()}}</td>
                                <td>
                                    <div class="progress-bar" role="progressbar"
                                         style="width: {{(($test->choices?->where('isCorrect')->count() * 100) / $test->test?->number_of_question)}}%"
                                         aria-valuenow="{{(($test->choices?->where('isCorrect')->count() * 100) / $test->test?->number_of_question)}}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                    {{(($test->choices?->where('isCorrect')->count() * 100) / $test->test?->number_of_question)}}
                                    %
                                </td>
                                <td>
                                    <a href="{{route('panel.user_test',['id' => $test->id])}}" class="btn btn-info">
                                        <i class="fa-light fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@section('scripts')
    <script src="/admin/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
@endsection
