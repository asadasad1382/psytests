<?php

namespace App\Http\Livewire\Panel;

use App\Http\Livewire\Breadcrumb;
use App\Models\UserTest;
use Livewire\Component;

class Dashboard extends Component
{
    use Breadcrumb;

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'داشبورد کاربر'
        ];
    }

    public function render()
    {
        $testsCount = UserTest::whereUserId(\Auth::id())->count();
        return view('livewire.panel.dashboard', compact('testsCount'))
            ->extends('layouts.panel.master')->section('main');
    }
}
