<div class="card col-md-10">

    <div class="card-header">
        <div class="text-center col-md-8 mx-auto">
            <img src="{{Storage::disk('public')->url('logo.png')}}" class="clearfix" alt="" height="80">
            <h5 class="card-title mt-2">ورود به سامانه جامع آزمون</h5>
        </div>
    </div>
    <div class="card-body col-md-8 mx-auto">
                @if (session()->has('message'))
            <div class="alert alert-success p-2">
                {{ session('message') }}
            </div>
        @endif

        <p class="alert alert-warning p-1">لطفا نام کاربری و رمز عبور خود را وارد کنید</p>

        @if ($errors->any())
            <div class="alert alert-danger p-1">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <label class="label" for="userName">نام کاربری </label>
            <input type="text" wire:model.defer="mobile" class="form-control">
            @error('mobile')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-3">
            <label for="userName">رمز عبور (رمز انتخابی هنگام ثبت نام در این سامانه)</label>
            <input type="password" wire:model.defer="password" class="form-control">
        </div>
    </div>
    <div class="card-footer text-center">
        <p class="mt-2">در صورتی که رمز عبور خود را فراموش کرده اید از این
            <a href="{{route('forgot')}}">لینک</a>
            نسبت به تغییر رمز عبور اقدام نمایید!</p>
        <p class="mt-2">در صورتی که برای اولین بار از سامانه استفاده می کنید ابتدا باید
            <a href="{{route('register')}}">ثبت نام</a>
            کنید!</p>
        <button class="btn btn-success w-50 mx-auto"
                wire:click="login" wire:target="login" wire:loading.attr="disabled">ورود
        </button>
        <a class="btn btn-primary" href="{{route('register')}}">ثبت نام</a>
    </div>
</div>

