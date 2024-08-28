<?php

namespace App\Http\Livewire\Admin;

use App\Filters\GlobalFilter;
use App\Http\Livewire\Breadcrumb;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserChoice;
use App\Models\UserTest;
use Illuminate\Pipeline\Pipeline;
use Livewire\Component;
use Livewire\WithPagination;
use PHPUnit\Exception;
use function PHPUnit\Framework\callback;

class Users extends Component
{
    use Breadcrumb, WithPagination;

    public $user_id, $first_name, $last_name, $father_name, $user_name, $mobile, $password, $profile, $filter;
    protected $paginationTheme = 'bootstrap';

    protected $rules = ['user' => 'nullable'];

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'مدیریت کاربران'
        ];

    }

    public function render()
    {
        $users = $this->getUsers();
        return view('livewire.admin.users', compact('users'))
            ->extends('layouts.admin.master')->section('main');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'active' => !$user->active
        ]);
    }

    private function getUsers()
    {
        return app(Pipeline::class)
            ->send(User::query())
            ->through([
                new GlobalFilter('user_name', $this->filter),
                new GlobalFilter('mobile', $this->filter),
                new GlobalFilter('last_name', $this->filter),
            ])
            ->thenReturn()
            ->orderBydesc('created_at')
            ->paginate();
    }

    public function register()
    {
        if ($this->user_id) {
            $validateDate = $this->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'father_name' => 'required',
                'user_name' => 'required',
                'mobile' => 'required',
                'password' => 'required',
            ]);
            $validateDate['password'] = \Hash::make($validateDate['password']);
            $user = User::find($this->user_id);
            $user->update($validateDate);
            session()->flash('message', 'ویرایش کاربر با موفقیت انجام شد!');
        } else {
            $validateDate = $this->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'father_name' => 'required',
                'user_name' => 'required|unique:users,user_name',
                'mobile' => 'required|unique:users,mobile',
                'password' => 'required',
            ]);
            $validateDate['password'] = \Hash::make($validateDate['password']);
            User::create($validateDate);
            session()->flash('message', 'ثبت نام با موفقیت انجام شد! منتظر تائید مدیر بمانید نتیجه فعال سازی از سمت مدیر برای شما ارسال میگردد');
        }
        $this->reset();

    }

    public function showProfile($user_id)
    {
        $this->profile = Profile::where('user_id', $user_id)->first();
        $this->dispatchBrowserEvent('profile-show');
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $this->user_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->father_name = $user->father_name;
        $this->user_name = $user->user_name;
        $this->mobile = $user->mobile;
    }

    public function delete($id)
    {
        try {
            \DB::transaction(function () use ($id) {
                $user = User::find($id);
                $userTests = UserTest::where('user_id', $user->id)->get();
                foreach ($userTests as $userTest) {
                    UserChoice::where('user_test_id', $userTest->id)->delete();
                    $userTest->delete();
                }
                $user->delete();
                session()->flash('message', 'حذف کاربر با موفقیت انجام شد!');
            });
        } catch (Exception $exception) {
            session()->flash('message', $exception->getMessage());
        }
    }
}
