<div class="mt-2">
    <label for="">{{$label}}</label>
    <input type="{{$type}}" class="{{$type === 'file' ?'': 'form-control'}}" wire:model="{{$model}}">
</div>
