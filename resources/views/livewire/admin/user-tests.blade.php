<div class="card">
    <div class="card-header">
        <h3 class="card-title">مشاهده نتیجه آزمون</h3>
        <input type="text" wire:model="search" class="col-md-4 form-control form-control-sm rounded" placeholder="جستجو...">
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
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
            @foreach($userTests as $test)
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
                        <a href="{{route('admin.user_test',['id' => $test->id])}}" class="btn btn-info">
                            <i class="fa-light fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $userTests->links() !!}
</div>
@include('livewire.admin.components.with-breadcrumb')
