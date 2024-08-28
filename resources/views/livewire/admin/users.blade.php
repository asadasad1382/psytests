<div class="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">افزودن کاربر جدید</h3>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                @if (session()->has('message'))
                    <div class="alert alert-success p-2">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="mt-2">
                    <label class="label" for="first_name">نام</label>
                    <input type="text" wire:model="first_name" class="form-control">
                    @error('first_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="label" for="last_name">نام خانوادگی</label>
                    <input type="text" wire:model="last_name" class="form-control">
                    @error('last_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="label" for="father_name">نام پدر</label>
                    <input type="text" wire:model="father_name" class="form-control">
                    @error('father_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="label" for="userName">کد ملی</label>
                    <input type="number" wire:model="user_name" class="form-control">
                    @error('user_name')
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
                    ایجاد / ویرایش کاربر
                </button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">کاربرن</h3>
            <input type="text" wire:model="filter" class="form-control form-control-sm rounded col-md-4 float-end">
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>نام پدر</th>
                    <th>موبایل</th>
                    <th>کد ملی</th>
                    <th>وضعیت</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->father_name}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->user_name}}</td>
                        <td>{{$user->active ? 'فعال' : 'غیر فعال'}}</td>
                        <td>
                            <div class="btn-group">
                                <button title="فعال/غیرفعال سازی"
                                        class="btn btn-{{$user->active ? 'danger' : 'success'}}"
                                        wire:loading.attr="disabled"
                                        wire:click=changeStatus({{$user->id}})">
                                    <i class="fa-light fa-{{$user->active ? 'ban' : 'check'}}"></i>
                                </button>
                                <button title="مشخصات" class="btn btn-info"
                                        wire:loading.attr="disabled"
                                        wire:click=showProfile({{$user->id}})">
                                    <i class="fa-light fa-eye"></i>
                                </button>
                                <button title="ویرایش" class="btn btn-primary"
                                        onclick="location.href = location.href +'#'"
                                        wire:loading.attr="disabled"
                                        wire:click=edit({{$user->id}})">
                                    <i class="fa-light fa-pencil"></i>
                                </button>
                                <button title="حذف" class="btn btn-danger"
                                        wire:loading.attr="disabled"
                                        wire:click=delete({{$user->id}})">
                                    <i class="fa-light fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $users->links() !!}
        </div>
    </div>
    <button id="profileShow" data-bs-toggle="modal" data-bs-target="#profileModal"></button>
    <div class="modal" tabindex="-1" id="profileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">اطلاعات کاربر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
                    @if($profile)
                        <table class="table">
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <td>{{$profile->user?->name}}</td>
                            </tr>
                            <tr>
                                <th>نام و نام خانوادگی (لاتین)</th>
                                <td>{{$profile->name_en}}</td>
                            </tr>
                            <tr>
                                <th>موبایل</th>
                                <td>{{$profile->user?->mobile}}</td>
                            </tr>
                            <tr>
                                <th>کد پستی</th>
                                <td>{{$profile->postel_code}}</td>
                            </tr>
                            <tr>
                                <th>آدرس</th>
                                <td>{{$profile->address}}</td>
                            </tr>
                            <tr>
                                <th>عکس پرسنلی</th>
                                <td>
                                    <a href="{{Storage::disk('public')->url($profile->personal_photo)}}"
                                       target="_blank">
                                        <img height="30"
                                             src="{{Storage::disk('public')->url($profile->personal_photo)}}">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>عکس کارت ملی</th>
                                <td>
                                    <a href="{{Storage::disk('public')->url($profile->national_photo)}}"
                                       target="_blank">
                                        <img height="30"
                                             src="{{Storage::disk('public')->url($profile->national_photo)}}">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>عکس رسید واریز</th>
                                <td>
                                    <a href="{{Storage::disk('public')->url($profile->deposit_photo)}}"
                                       target="_blank">
                                        <img height="30"
                                             src="{{Storage::disk('public')->url($profile->deposit_photo)}}">
                                    </a>
                                </td>
                            </tr>
                        </table>
                    @else
                        <p class="text-danger">کاربر تکمیل ثبت نام نکرده است!</p>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                </div>
            </div>
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
