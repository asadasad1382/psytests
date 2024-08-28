<div class="card col-md-10">
    <div class="card-header">
        <div class="text-center col-md-8 mx-auto">
            <img src="{{Storage::disk('public')->url('logo.png')}}" class="clearfix" alt="" height="80">
            <h5 class="card-title mt-2">ثبت نام در سامانه جامع آزمون</h5>
        </div>
    </div>
    <div class="card-body col-md-8 mx-auto row">
        <p class="alert alert-warning p-1">لطفا اطلاعات زیر را تکمیل کنید</p>
        @if (session()->has('message'))
            <div class="alert alert-success p-2">
                {{ session('message') }}
            </div>
        @endif
        
        @error('duplicate')
                        <div class="alert alert-danger p-1">
                            <span>
            شما قبلا ثبت نام کرده اید. لطفا  <a href="login">وارد شوید</a> یا از <a href="forgot-password">فراموشی رمز عبور</a> استفاده کنید.
</span>
                        </div>
        @enderror
        
        <div class="mt-2 col-md-4 ">
            <label class="label" for="first_name">نام</label>
            <input type="text" wire:model="first_name" class="form-control">
            @error('first_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="last_name">نام خانوادگی</label>
            <input type="text" wire:model="last_name" class="form-control">
            @error('last_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="father_name">نام پدر</label>
            <input type="text" wire:model="father_name" class="form-control">
            @error('father_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="userName">کد ملی</label>
            <input type="number" wire:model="user_name" class="form-control">
            @error('user_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="mobile">موبایل</label>
            <input type="number" wire:model="mobile" class="form-control">
            @error('mobile')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="province_id">استان</label>
            <select wire:model="province_id" class="form-control">
                @foreach($provinces as $province)
                    <option default value={{$province['id']}}>
                        {{$province['value']}}
                    </option>
                @endforeach
            </select>
            @error('province_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="gender">جنسیت</label>
            <select name="gender" wire:model="gender" class="form-control" value="زن">
                <option selected >زن</option>
                <option>مرد</option>
            </select>
            @error('gender')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="birthday">سال تولد</label>
            <input type="number" wire:model="birthday" class="form-control">
            @error('birthday')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2 col-md-4">
            <label class="label" for="reshteh">رشته</label>
            <input wire:model="reshteh" class="form-control">

            @error('reshteh')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mt-2 col-md-6">
            <label class="label" for="password">رمز عبور</label>
            <input type="password" wire:model="password" class="form-control">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        <div class="mt-2 col-md-6">
            <label class="label" for="password">تکرار رمز عبور</label>
            <input type="password" wire:model="password_confirmation" class="form-control">
            @error('password_confirmation')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer text-center">
        <button class="btn btn-success w-50 mx-auto"
                wire:click="register" wire:target="register" wire:loading.attr="disabled">ثبت نام
        </button>
        <a class="btn btn-primary" href="{{route('login')}}">ورود</a>
    </div>
</div>
