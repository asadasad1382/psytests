@if (session()->has('message'))
    <div class="alert alert-success p-2">
        {{ session('message') }}
    </div>
@endif
