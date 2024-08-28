<div class="mt-2">
    <label for="">{{$label}}</label>
    <select class="form-control" wire:model="{{$model}}">
        <option value=""></option>
        @foreach($data as $item)
            <option value="{{$item[$key]}}">{{$item[$value]}}</option>
        @endforeach
    </select>
</div>
