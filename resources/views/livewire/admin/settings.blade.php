<div class="">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تنظیمات سامانه</h3>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                @include('components.message')
                <div>
                    <label for="">عنوان</label>
                    <input type="text" class="form-control" wire:model.defer="title">
                </div>
                <div class="mt-2">
                    <label for="">لوگو</label>
                    <input type="file" accept="image/*" wire:model="logo">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div>
                <button class="btn btn-success"
                        wire:target="logo"
                        wire:loading.attr="disabled"
                        wire:click="store">ثبت
                </button>
            </div>
        </div>
    </div>
</div>
@include('livewire.admin.components.with-breadcrumb')
