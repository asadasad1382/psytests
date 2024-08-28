<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Breadcrumb;
use Livewire\Component;

class UserTest extends Component
{
    use Breadcrumb;

    public $user_test;

    public function mount($id)
    {
        $this->user_test = \App\Models\UserTest::with(['choices', 'test'])->findOrFail($id);
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'نتیجه آزمون'
        ];
    }

    public function render()
    {
        return view('livewire.admin.user-test')
            ->extends('layouts.admin.master')->section('main');
    }
}
