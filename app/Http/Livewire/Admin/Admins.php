<?php

namespace App\Http\Livewire\Admin;

use App\Filters\GlobalFilter;
use App\Http\Livewire\Breadcrumb;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Pipeline\Pipeline;
use Livewire\Component;
use Livewire\WithPagination;

class Admins extends Component
{
    use Breadcrumb, WithPagination;

    public $admin_id, $name, $email, $mobile, $password, $filter;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'مدیریت کاربران'
        ];

    }

    public function render()
    {
        $admins = $this->getAdmins();
        return view('livewire.admin.admins', compact('admins'))
            ->extends('layouts.admin.master')->section('main');
    }

    private function getAdmins()
    {
        return app(Pipeline::class)
            ->send(Admin::query())
            ->through([
                new GlobalFilter('email', $this->filter),
                new GlobalFilter('mobile', $this->filter),
            ])
            ->thenReturn()
            ->orderBydesc('created_at')
            ->paginate();
    }

    public function register()
    {
        if ($this->admin_id) {
            $validateDate = $this->validate([
                'email' => 'required',
                'name' => 'required',
                'mobile' => 'required',
                'password' => 'required',
            ]);
            $validateDate['password'] = \Hash::make($validateDate['password']);
            $user = Admin::find($this->admin_id);
            $user->update($validateDate);
            session()->flash('message', 'ویرایش مدیر با موفقیت انجام شد!');
        } else {
            $validateDate = $this->validate([
                'email' => 'required|unique:admins,email',
                'name' => 'required',
                'mobile' => 'required|unique:admins,mobile',
                'password' => 'required',
            ]);
            $validateDate['password'] = \Hash::make($validateDate['password']);
            Admin::create($validateDate);
            session()->flash('message', 'مدیر جدید با موفقیت ایجاد شد!');
        }
        $this->reset();
    }

    public function edit($admin_id)
    {
        $admin = Admin::find($admin_id);
        $this->admin_id = $admin->id;
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->mobile = $admin->mobile;
    }

    public function delete($id)
    {
        try {
            \DB::transaction(function () use ($id) {
                $admin = Admin::find($id);
                if (\Auth::guard('admin')->id() === $admin->id) {
                    session()->flash('message', 'امکان حذف مدیر فعلی وجود ندارد!');
                    return;
                }
                $admin->delete();
                session()->flash('message', 'حذف مدیر با موفقیت انجام شد!');
            });
        } catch (\Exception $exception) {
            session()->flash('message', $exception->getMessage());
        }
    }
}
