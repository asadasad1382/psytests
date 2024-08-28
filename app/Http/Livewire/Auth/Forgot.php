<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Notifications\VerifyNotification;
use Livewire\Component;

class Forgot extends Component
{
    public $user, $user_name, $code, $password, $level = 1, $randomCode;

    public function render()
    {
        return view('livewire.auth.forgot')
            ->extends('layouts.admin.master')->section('main');
    }

    public function sendCode()
    {
        $validateDate = $this->validate([
            'user_name' => 'required|exists:users,user_name',
        ]);
        $this->user = User::where('user_name', $this->user_name)->first();

        $this->randomCode = rand(111111, 999999);

        $this->user->notify(new VerifyNotification($this->randomCode));
        $this->level = 2;
    }

    public function changePassword()
    {
        $validateDate = $this->validate([
            'code' => 'required|numeric',
            'password' => 'required',
        ]);
        if ($this->code != $this->randomCode) {
            $this->addError('code', 'کد وارد شده نامعتبر است!');
            return;
        }

        $this->user->update([
            'password' => \Hash::make($validateDate['password'])
        ]);

        return redirect(route('login'))->with(['عملیات با موفقیت انجام شد!']);
    }
}
