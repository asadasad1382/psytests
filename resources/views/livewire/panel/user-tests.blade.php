<div class="card">
    <div class="card-header">
        <h3 class="card-title">مشاهده نتیجه آزمون</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>زمان آزمون</th>
                <th>نام آزمون</th>
                <th>ip</th>
                <th>مدت پاسخ گویی</th>
                <th>تعداد کل سوالات پاسخ داده شده</th>
                <th>تعداد سوالات بی جواب</th>
                <th>درصد</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($userTests as $userTest)
                <tr>
                    <td>{{$userTest->created_at}}</td>
                    <td>{{$userTest->test?->name}}</td>
                    <td>{{$userTest->ip_address}}</td>
                    <td>{{$userTest->time_length}}</td>
                    <td>{{$userTest->choices->where('answer','!=',null)?->count()}}</td>
                    <td>{{$userTest->choices->where('answer',null)?->count()}}</td>
                    <td>
                        <div class="progress-bar" role="progressbar"
                             style="width: {{(($userTest->choices?->where('isCorrect')->count() * 100) / $userTest->test?->number_of_question)}}%"
                             aria-valuenow="{{(($userTest->choices?->where('isCorrect')->count() * 100) / $userTest->test?->number_of_question)}}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                        {{(($userTest->choices?->where('isCorrect')->count() * 100) / $userTest->test?->number_of_question)}}
                        %
                    </td>
                    <td>
                        <a href="{{route('result',['id' => $userTest->id])}}" class="btn btn-info">
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
