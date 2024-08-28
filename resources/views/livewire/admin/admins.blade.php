<div class="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">افزودن مدیر جدید</h3>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                @include('components.message')
                <div class="mt-2">
                    <label class="label" for="name">نام</label>
                    <input type="text" wire:model="name" class="form-control">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="label" for="email">ایمیل</label>
                    <input type="text" wire:model="email" class="form-control">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="label" for="mobile">موبایل</label>
                    <input type="number" wire:model="mobile" class="form-control">
                    @error('mobile')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="label" for="password">رمز عبور</label>
                    <input type="password" wire:model="password" class="form-control">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer text-center mt-5">
                <button class="btn btn-success w-50 mx-auto"
                        wire:click="register" wire:target="register" wire:loading.attr="disabled">
                    ایجاد / ویرایش مدیر
                </button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">مدیران</h3>
            <input type="text" wire:model="filter" class="form-control form-control-sm rounded col-md-4 float-end">
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>موبایل</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->mobile}}</td>
                        <td>
                            <div class="btn-group">
                                <button title="ویرایش" class="btn btn-primary"
                                        onclick="location.href = location.href +'#'"
                                        wire:loading.attr="disabled"
                                        wire:click=edit({{$admin->id}})">
                                    <i class="fa-light fa-pencil"></i>
                                </button>
                                <button title="حذف" class="btn btn-danger"
                                        wire:loading.attr="disabled"
                                        wire:click=delete({{$admin->id}})">
                                    <i class="fa-light fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $admins->links() !!}
        </div>
    </div>
</div>
@include('livewire.admin.components.with-breadcrumb')
@section('extraJs')
    <script>
        window.addEventListener('profile-show', function () {
            $('#profileShow').click()
        })
    </script>
@endsection
