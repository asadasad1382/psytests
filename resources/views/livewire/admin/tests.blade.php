<div class="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ایجاد آزمون جدید</h3>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                @component('components.form-input',['label' => 'نام','model' => 'name','type' => 'text'])@endcomponent
                @component('components.form-input',['label' => 'تعداد سوالات نهایی','model' => 'number_of_question','type' => 'number'])@endcomponent
                @component('components.form-input',['label' => 'مدت زمان آزمون','model' => 'time','type' => 'number'])@endcomponent
                @component('components.form-select',['label' => 'دسته بندی آزمون؟','model' => 'category_id','data' =>$categories ,'key' => 'id', 'value' => 'title'])@endcomponent
                @component('components.form-select',['label' => 'اين آزمون، آزمون پيشفرض باشد؟','model' => 'default','data' =>[['id' => '0', 'value' => 'خیر'],['id' => '1', 'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                @component('components.form-select',['label' => 'سؤالات به صورت رندوم نمايش داده شوند؟','model' => 'random','data' =>[['id' => '0', 'value' => 'خیر'],['id' => '1', 'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                @component('components.form-select',['label' => 'سؤالات از راست به چپ نمايش داده شوند؟','model' => 'rtl','data' =>[['id' => '0', 'value' => 'خیر'],['id' => '1', 'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                @component('components.form-select',['label' => 'اين آزمون نمره منفي دارد؟','model' => 'minus_mark','data' =>[['id' => '0', 'value' => 'خیر'],['id' => '1', 'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                @component('components.form-select',['label' => 'جواب سؤالات در انتهاي آزمون به داوطلب نشان داده شود؟','model' => 'show_answers','data' =>[['id' => '0', 'value' => 'خیر'],['id' => '1', 'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                @component('components.form-select',['label' => 'نمره نهايي داوطلب، در انتهاي آزمون به او نشان داده شود؟','model' => 'show_mark','data' =>[['id' => '0', 'value' => 'خیر'],['id' => '1', 'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                @component('components.form-select',['label' => 'رتبه داوطلب در آزمون و عملکرد دیگران به داوطلب نمایش داده شود؟','model' => 'show_rank','data' =>[['id' => '0', 'value' => 'خیر'],['id' => '1', 'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                <div class="mt-2">
                    <label for="">پيغام قبل از آغاز آزمون</label>
                    <textarea class="form-control" rows="4" wire:model="start_message"></textarea>
                </div>
                <div class="mt-2">
                    <label for="">پيغام پايين صفحه آزمون</label>
                    <textarea class="form-control" rows="4" wire:model="end_message"></textarea>
                </div>
                <div class="mt-2">
                    <button class="btn btn-success"
                            wire:target="imgae"
                            wire:loading.attr="disabled"
                            wire:click="store">
                        ثبت و تعریف سوالات
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">دسته ها</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام آزمون</th>
                    <th>فعال</th>
                    <th>تعداد سؤالات تعريف شده</th>
                    <th>عداد سؤالات نهايي</th>
                    <th>زمان (دقيقه)</th>
                    <th>پيشفرض</th>
                    <th>رندوم</th>
                    <th>چينش سؤالات</th>
                    <th>نمره منفي</th>
                    <th>نمايش پاسخ درست</th>
                    <th>نمايش نمره نهايي</th>
                    <th>نمایش رتبه</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tests as $test)
                    <tr>
                        <td>{{$test->id}}</td>
                        <td>{{$test->name}}</td>
                        <td>{{$test->active}}</td>
                        <td>{{$test->questions->count()}}</td>
                        <td>{{$test->number_of_question}}</td>
                        <td>{{$test->time}}</td>
                        <td>{{$test->default}}</td>
                        <td>{{$test->random}}</td>
                        <td>{{$test->rtl ? 'راست به چپ' : 'چپ به راست'}}</td>
                        <td>{{$test->minus_mark}}</td>
                        <td>{{$test->show_answers}}</td>
                        <td>{{$test->show_mark}}</td>
                        <td>{{$test->show_rank}}</td>
                        <td>
                            <div class="btn-group">
                                <button
                                    onclick="location.href = location.href + '#'"
                                    class="btn btn-info" wire:click="edit({{$test}})">
                                    <i class="fa-light fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger" wire:click="destroy({{$test}})">
                                    <i class="fa-light fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! $tests->links() !!}
</div>
@include('livewire.admin.components.with-breadcrumb')
