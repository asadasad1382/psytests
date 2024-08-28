<div class="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ایجاد دسته جدید</h3>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                @include('components.message')
                <div>
                    <label for="">عنوان</label>
                    <input type="text" class="form-control" wire:model="title">
                </div>
                <div class="mt-2">
                    <label for="">تصویر</label>
                    <input type="file" accept="image/*" wire:model="image">
                </div>
                <div class="mt-2">
                    <label for="">توضیحات</label>
                    <textarea class="form-control" rows="3" wire:model="body"></textarea>
                </div>
                <div class="mt-2">
                    <button class="btn btn-success"
                            wire:target="imgae"
                            wire:loading.attr="disabled"
                            wire:click="store">ثبت
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
                    <th>عنوان</th>
                    <th>تصویر</th>
                    <th>توضیحات</th>
                    <th>تاریخ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->title}}</td>
                        <td><img src="{{Storage::disk('public')->url($category->image)}}" height="50"></td>
                        <td>{{$category->body}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>
                            <div class="btn-group">
                                <button
                                    onclick="location.href = location.href + '#'"
                                    class="btn btn-info" wire:click="edit({{$category}})">
                                    <i class="fa-light fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger" wire:click="destroy({{$category}})">
                                    <i class="fa-light fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $categories->links() !!}
        </div>
    </div>
</div>
@include('livewire.admin.components.with-breadcrumb')
