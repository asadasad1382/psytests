<script type="text/javascript">
  !function(){var i="mwXQS3",a=window,d=document;function g(){var g=d.createElement("script"),s="https://www.goftino.com/widget/"+i,l=localStorage.getItem("goftino_"+i);g.async=!0,g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}"complete"===d.readyState?g():a.attachEvent?a.attachEvent("onload",g):a.addEventListener("load",g,!1);}();
</script>

<div class="card col-md-10">
    <div class="card-header">
        <div class="text-center col-md-8 mx-auto">
            <img src="{{Storage::disk('public')->url('logo.png')}}" class="clearfix" alt="" height="80">
            <h5 class="card-title mt-2">تغییر رمز عبور در سامانه جامع آزمون</h5>
        </div>
    </div>
    @if($level === 1)
        <div class="card-body col-md-8 mx-auto">
            <p class="alert alert-warning p-1">لطفا نام کاربری را وارد کنید</p>

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
                <label class="label" for="userName">نام کاربری (کد ملی)</label>
                <input type="text" wire:model="user_name" class="form-control">
                @error('user_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    @else
        <div class="card-body col-md-8 mx-auto">
            <p class="alert alert-success p-1">کد اعتبار سنجی به شماره موبایل شما ارسال شد!</p>

            <p class="alert alert-warning p-1">لطفا کد دریافتی در موبایل به همراه رمز عبور جدید را وارد کنید</p>

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
                <label class="label" for="code">کد دریافتی (پیامک شده به موبایل)</label>
                <input type="number" wire:model="code" class="form-control">
                @error('code')
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
    @endif

    <div class="card-footer text-center">
        <p class="mt-2">در صورتی که برای اولین بار از سامانه استفاده می کنید ابتدا باید
            <a href="{{route('register')}}">ثبت نام</a>
            کنید!</p>
        @if($level === 1)
            <button class="btn btn-success w-50 mx-auto"
                    wire:click="sendCode" wire:target="sendCode" wire:loading.attr="disabled">ارسال کد
            </button>
        @else
            <button class="btn btn-success w-50 mx-auto"
                    wire:click="changePassword" wire:target="changePassword" wire:loading.attr="disabled">تغییر رمز
            </button>
        @endif
        <a class="btn btn-primary" href="{{route('login')}}">ورود</a>
    </div>
</div>
