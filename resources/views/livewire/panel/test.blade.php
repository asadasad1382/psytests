<div>
    <div>
@if ($user_test && $user_test->finish == 0 && $user_test->transaction()->where('status','paid')->exists())
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">بانک سوالات</h3>
                <div class="">
                    <p>
                        زمان باقی مانده :
                        <span id="timer">{{$timer}}</span>
                        دقیقه
                    </p>
                </div>

            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        @if($test->has_two_answers == 0)
                            <th>سوال</th>
                            <th></th>
                            <th>گزینه ها</th>
                        @else
                            <th></th>
                            <th>سوالات</th>
                            <th>بیشترین</th>
                            <th>کمترین</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$question->question}}</td>
                            @if($test->has_two_answers == 0)
`                                <td>
`                                    <div class="form-check">
                                        <input class="form-check-input" wire:change="updateAnswers()" wire:model.debounce="answers.{{$loop->index}}.answer"
                                               type="radio"
                                               name="choices{{$loop->index}}" id="choice1{{$loop->index}}" value="1">
                                        <label class="form-check-label" for="choice1{{$loop->index}}">
                                            {{$question->choice1}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:change="updateAnswers()" wire:model.debounce="answers.{{$loop->index}}.answer"
                                               type="radio" name="choices{{$loop->index}}" id="choice2{{$loop->index}}"
                                               value="2">
                                        <label class="form-check-label" for="choice2{{$loop->index}}">
                                            {{$question->choice2}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:change="updateAnswers()" wire:model.debounce="answers.{{$loop->index}}.answer"
                                               type="radio" name="choices{{$loop->index}}" id="choice3{{$loop->index}}"
                                               value="3">
                                        <label class="form-check-label" for="choice3{{$loop->index}}">
                                            {{$question->choice3}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model.debounce="answers.{{$loop->index}}.answer"
                                               type="radio" name="choices{{$loop->index}}" id="choice4{{$loop->index}}"
                                               value="4">
                                        <label class="form-check-label" for="choice4{{$loop->index}}">
                                            {{$question->choice4}}
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div style="margin-top: 10px !important;">{{$question->choice1}}</div>
                                    <div style="margin-top: 10px !important;">{{$question->choice2}}</div>
                                    <div style="margin-top: 10px !important;">{{$question->choice3}}</div>
                                    <div style="margin-top: 10px !important;">{{$question->choice4}}</div>
                                </td>
                                <td>
                                    @for ($i = 1;$i < 5;$i++)
                                        <div class="form-check" style="margin-top: 10px !important;">
                                            <input  wire:change="updateAnswers()" wire:model.debounce="answers.{{$loop->index}}.answer"
                                                   type="radio" name="choices1{{$loop->index}}" id="choice1{{$i}}{{$loop->index}}"
                                                   value={{ json_decode($question->sinatik_id,true)[$i - 1] }}>
                                        </div>
                                    @endfor
                                </td>
                                <td>
                                    @for ($i = 1;$i < 5;$i++)
                                        <div class="form-check" style="margin-top: 10px !important;">
                                            <input  wire:change="updateAnswers()" wire:model.debounce="answers.{{$loop->index}}.answer2"
                                                   type="radio" name="choices2{{$loop->index}}" id="choice2{{$i}}{{$loop->index}}"
                                                   value={{json_decode($question->sinatik_id,true)[$i - 1]}}>
                                        </div>
                                    @endfor

                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @error('endTest')
            <div class="alert p-3 alert-danger">
                {{$message}}
            </div>
            @enderror
            <div class="card-footer">
                <button
                    wire:target="answers"
                    wire:loading.attr="disabled"
                    {{count(array_column($answers,'answer')) != $test->number_of_question || count(array_column($answers,'answer2')) != $test->number_of_question ? "disabled" : ''}}
                    class="btn btn-success" wire:click="end">پایان آزمون</button>
            </div>
        </div>
    @elseif ($user_test && $user_test->finish == 1 && $user_test->transaction()->where('status','paid')->exists())
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">شروع آزمون جدید</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning p-3">
                    شما تا کنون {{$user_test_count}} در این آزمون شرکت کرده اید!
                    <br>

                </div>
                <hr>
                <p>{{$test->end_message}}</p>

                <a  target="_blank" href="{{route('result',['id' => $user_test->id])}}" class="btn btn-primary">
                    دانلود نتیجه آزمون
                </a>
                <button class="btn btn-success" wire:click="payment" wire:target="payment" wire:loading.attr="disabled">شروع
                    آزمون جدید
                </button>
            </div>
        </div>
    @elseif (! $user_test && $user_test->transaction()->where('status','paid')->exists())
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">شروع آزمون</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning p-3">
                    شما تا کنون {{$user_test_count}} در این آزمون شرکت کرده اید!
                    <br>
                    تعدا مجاز شرکت در آزمون 3 بار می باشد
                </div>
                <hr>
                <p>{{$test->start_message}}</p>
                <table class="table">
                    <tbody>
                    <tr>
                        <th>نام آزمون</th>
                        <td>{{$test->name}}</td>
                    </tr>
                    <tr>
                        <th>زمان آزمون</th>
                        <td>{{$test->time}} دقیقه</td>
                    </tr>
                    <tr>
                        <th>تعداد سوالات</th>
                        <td>{{$test->number_of_question}} </td>
                    </tr>
                    </tbody>
                </table>
                @error('startTest')
                <div class="alert p-3 alert-danger">
                    {{$message}}
                </div>
                <p>هزینه تمدید سروریس آزمون برای 3 مرتبه {{number_format(Setting::get('renewPrice')?:0)}} تومان می
                    باشد</p>
                <button class="btn btn-success" wire:click="payment" wire:target="payment" wire:loading.attr="disabled">
                    تمدید آزمون
                </button>
                @else
                    <button class="btn btn-success" wire:click="start" wire:target="start" wire:loading.attr="disabled">
                        شروع
                        آزمون
                    </button>
                    @enderror
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> خرید آزمون {{ $test->name }}</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning p-3">
                    شما تا کنون {{$user_test_count}} در این آزمون شرکت کرده اید!
                    <br>
                    تعدا مجاز شرکت در آزمون 3 بار می باشد
                </div>
                <hr>
                <p>{{$test->end_message}}</p>

                <button class="btn btn-success" wire:click="payment" wire:target="payment" wire:loading.attr="disabled">
                    خرید آزمون
                </button>
            </div>
        </div>

    @endif
    @include('livewire.admin.components.with-breadcrumb')
</>
@section('extraJs')
    <script>
        window.addEventListener('timer-start', () => {
            console.log(654654)
            var timer = `{{$timer}}`;
            let interval = setInterval(function () {
                $('#timer').text(timer--)
                if (timer <= 0) {
                    clearInterval(interval)
                }
            }, 60000)
        })
    </script>
@endsection
