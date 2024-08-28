<?php

namespace App\Http\Livewire\Admin;

use App\Filters\GlobalWhereInFilter;
use App\Http\Livewire\Breadcrumb;
use App\Models\User;
use App\Models\UserTest;
use Illuminate\Pipeline\Pipeline;
use Livewire\Component;
use Livewire\WithPagination;

class UserTests extends Component
{
    use Breadcrumb, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'نتیجه آزمون'
        ];
    }

    public function render()
    {
        $userTests = $this->getUserTests();
        return view('livewire.admin.user-tests', compact('userTests'))
            ->extends('layouts.admin.master')->section('main');
    }

    private function getUserTests()
    {
        if ($this->search) {
            $users = User::where('first_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $this->search . '%')
                ->orWhere('user_name', 'LIKE', '%' . $this->search . '%')->pluck('id')->toArray();
        } else {
            $users = null;
        }

        return app(Pipeline::class)
            ->send(UserTest::query())
            ->through([
                new GlobalWhereInFilter('user_id', $users)
            ])
            ->thenReturn()
            ->orderBydesc('created_at')
            ->paginate();
    }
}
