<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $mobile, $password, $type;

    protected $queryString = ['type'];

    public function mount()
    {
        if(auth()->check()){
            return $this->redirect(route('panel.dashboard'));
        }
    }
    public function render()
    {

        return view('livewire.auth.login')
            ->extends('layouts.admin.master')->section('main');
    }

    public function login()
    {

        if ($this->type === 'admin') {
            $data = [
                'mobile' => $this->mobile,
                'password' => $this->password
            ];

            if (Auth::guard('admin')->attempt($data)) {
                return $this->redirect(route('admin.dashboard'));
            } else {
                $this->addError('mobile', 'نام کاربری و یا رمز نامعتبر است!');
            }
        } else {
            $data = [
                'user_name' => $this->mobile,
                'password' => $this->password
            ];

            if (Auth::attempt($data)) {
                return $this->redirect(route('panel.dashboard'));
            } else {
                $this->addError('mobile', 'نام کاربری و یا رمز نامعتبر است!');
            }
        }
    }
}
