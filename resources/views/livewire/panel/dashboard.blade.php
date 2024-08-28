<section id="dashboard-analytics">
    <div class="row match-height">
        <!-- Greetings Card starts -->
        <div class="col-lg-12 col-md-12 col-sm-12" wire:ignore>
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
                        <h1 class="mb-1 text-white">به پنل کاربری خوش آمدید</h1>
                        <p class="card-text m-auto w-75">
                            سامانه جامع آزمون
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Greetings Card ends -->


        <div class="col-lg-4 col-sm-6 col-12" wire:ignore>
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="fa-light fa-question-circle fa-3x"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1">{{$testsCount}}</h2>
                    <p class="card-text">آزمون های انجام شده</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12" wire:ignore>
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="fa-light fa-hourglass-start fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <a class="btn btn-outline-dark w-100" href="{{route('panel.categories')}}">
                        شروع آزمون
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12" wire:ignore>
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="fa-light fa-list fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <a href="{{route('panel.user_tests')}}" class="btn btn-outline-dark w-100">
                        مشاهده آزمون های قبلی
                    </a>
                </div>
            </div>
        </div>

        @include('livewire.admin.components.with-breadcrumb')
    </div>
</section>
@section('scripts')
    <script src="/admin/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
@endsection
