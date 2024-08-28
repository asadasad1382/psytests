@extends('layouts/admin/master')

@section('title', 'ارور لایسنس')

@section('main')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <p class="alert alert-danger">{{$error}}</p>
        </div>
        @livewire('license.rtl-licence')
    </div>
@endsection
