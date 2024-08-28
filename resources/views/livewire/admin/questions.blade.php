<div class="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ایجاد سوال جدید</h3>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                @component('components.form-select',['label' => 'آزمون','model' => 'test_id','data' =>$tests ,'key' => 'id', 'value' => 'name'])@endcomponent
                <div class="mt-2">
                    <label for="">سوال</label>
                    <textarea class="form-control" rows="4" wire:model="question"></textarea>
                </div>
                <div class="mt-2">
                    <label for="">گزینه 1</label>
                    <textarea class="form-control" rows="4" wire:model="choice1"></textarea>
                </div>
                <div class="mt-2">
                    <label for="">گزینه 2</label>
                    <textarea class="form-control" rows="4" wire:model="choice2"></textarea>
                </div>
                <div class="mt-2">
                    <label for="">گزینه 3</label>
                    <textarea class="form-control" rows="4" wire:model="choice3"></textarea>
                </div>
                <div class="mt-2">
                    <label for="">گزینه 4</label>
                    <textarea class="form-control" rows="4" wire:model="choice4"></textarea>
                </div>

                @component('components.form-select',['label' => 'گزینه صحیح','model' => 'answer','data' =>[['id' => 1,'value' => 'گزینه 1'],['id' => 2,'value' => 'گزینه 2'],['id' => 3,'value' => 'گزینه 3'],['id' => 4,'value' => 'گزینه 4']] ,'key' => 'id', 'value' => 'value'])@endcomponent
                @component('components.form-select',['label' => 'گزینه های سوال رندوم باشد؟','model' => 'random','data' =>[['id' => 1,'value' => 'خیر'],['id' => 0,'value' => 'بله']] ,'key' => 'id', 'value' => 'value'])@endcomponent

                <div class="mt-2">
                    <button class="btn btn-success"
                            wire:target="imgae"
                            wire:loading.attr="disabled"
                            wire:click="store">
                        ثبت
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">بانک سوالات</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>آزمون</th>
                    <th>سوال</th>
                    <th>گزینه ها</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{$question->id}}</td>
                        <td>{{$question->test?->name}}</td>
                        <td>{{$question->question}}</td>
                        <td>
                            <span> {!! $question->answer === 1 ? "<i class='fa-light fa-check'></i>" : ""!!} {{$question->choice1}}</span><br>
                            <span> {!!$question->answer === 2 ? "<i class='fa-light fa-check'></i>" : ""!!} {{$question->choice2}}</span><br>
                            <span> {!!$question->answer === 3 ? "<i class='fa-light fa-check'></i>" : ""!!} {{$question->choice3}}</span><br>
                            <span> {!!$question->answer === 4 ? "<i class='fa-light fa-check'></i>" : ""!!} {{$question->choice4}}</span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button
                                    onclick="location.href = location.href + '#'"
                                    class="btn btn-info" wire:click="edit({{$question}})">
                                    <i class="fa-light fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger" wire:click="destroy({{$question}})">
                                    <i class="fa-light fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $questions->links() !!}
        </div>
    </div>
</div>
@include('livewire.admin.components.with-breadcrumb')
