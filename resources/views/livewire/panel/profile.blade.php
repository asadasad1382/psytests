<div class="card col-md-10">
    <div class="card-header">
        <div class="text-center col-md-8 mx-auto">
            <h5 class="card-title mt-2">تکمیل ثبت نام</h5>
        </div>
    </div>
    <div class="card-body col-md-8 mx-auto">
        <ul class="alert alert-warning p-2 un">
            <li>اسکن عکس پرسنلی 4*3 (برای درج بروی مدرک بین المللی)</li>
            <li>نام و نام خانوادگی به انگلیسی</li>
            <li>عکس رسید واریز (در صورت پرداخت آنلاین نیاز نمی باشد)</li>
            <li>عکس کارت ملی (یا هر کارت شناسایی معتبر دیگری)</li>
            <li>آدرس دقیق پستی با کدپستی (به آدرسهای بدون کد پستی، پست بسته ارسال نمیکند)</li>
        </ul>
        @if ($profile)
            <p class="alert alert-danger p-2 mt-2">شما قبلا اطلاعات را ارسال کرده اید و نیاز به ارسال مجدد اطلاعات نمی
                باشد.</p>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success p-2">
                {{ session('message') }}
            </div>
        @endif
        <div class="mt-2">
            <label class="label" for="name_en">نام و نام خانوادگی (انگلیسی)</label>
            <input type="text" wire:model="name_en" class="form-control" style="text-align: end">
            @error('name_en')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label class="label" for="address">آدرس دقیق پستی</label>
            <textarea type="text" wire:model="address" class="form-control" rows="1"></textarea>
            @error('address')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mt-2">
            <label class="label" for="postel_code">کد پستی (به صورت عددی و بدون فاصله یا -)</label>
            <input type="text" wire:model="postel_code" class="form-control">
            @error('postel_code')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label class="label" for="personal_photo">تصویر پرسنلی</label>
            <input type="file" accept="image/*" wire:model="personal_photo" class="form-control">
            @error('personal_photo')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label class="label" for="national_photo">تصویر کارت ملی</label>
            <input type="file" accept="image/*" wire:model="national_photo" class="form-control">
            @error('national_photo')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-2">
            <label class="label" for="deposit_photo">رسید واریز</label>
            <input type="file" accept="image/*" wire:model="deposit_photo" class="form-control">
            @error('deposit_photo')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="card-footer text-center">
        <div wire:loading.remove>
            <button class="btn btn-success w-50 mx-auto"
                    wire:click="submit" wire:loading.attr="disabled">
                ارسال اطلاعات
            </button>
        </div>
    </div>
</div>
