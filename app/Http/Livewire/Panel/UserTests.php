<?php

namespace App\Http\Livewire\Panel;

use App\Http\Livewire\Breadcrumb;
use Livewire\Component;
use Livewire\WithPagination;

class UserTests extends Component
{
    use Breadcrumb, WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'نتیجه آزمون'
        ];
    }

    public function render()
    {
        $userTests = \App\Models\UserTest::where('user_id', \Auth::id())
            ->where('finish', 1)
            ->orderByDesc('created_at')
            ->paginate();
        return view('livewire.panel.user-tests', compact('userTests'))
            ->extends('layouts.panel.master')->section('main');
    }
}
