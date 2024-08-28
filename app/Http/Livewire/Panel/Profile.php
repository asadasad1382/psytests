<?php

namespace App\Http\Livewire\Panel;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $profile, $name_en, $personal_photo, $deposit_photo, $national_photo, $address, $postel_code;

    public function mount()
    {
        $this->profile = \App\Models\Profile::where('user_id', \Auth::id())->first();
        if ($this->profile) {
            $this->name_en = $this->profile->name_en;
            $this->address = $this->profile->address;
            $this->postel_code = $this->profile->postel_code;
        }
    }

    public function render()
    {
        $user = \Auth::user();

        return view('livewire.panel.profile', compact('user'))
            ->extends('layouts.panel.master')->section('main');
    }

    public function submit()
    {
        $this->validate([
            'name_en' => 'required',
            'personal_photo' => 'required|image',
            'deposit_photo' => 'nullable|image',
            'national_photo' => 'required|image',
            'address' => 'required',
            'postel_code' => 'required'
        ]);
        if ($this->profile) {
            $this->profile->update([
                'name_en' => $this->name_en,
                'personal_photo' => $this->personal_photo ? $this->personal_photo->store('profile', 'public') :
                    $this->profile->personal_photo,
                'deposit_photo' => $this->deposit_photo ? $this->deposit_photo->store('profile', 'public') :
                    $this->profile->deposit_photo,
                'national_photo' => $this->national_photo ? $this->national_photo->store('profile', 'public') :
                    $this->profile->national_photo,
                'address' => $this->address,
                'postel_code' => $this->postel_code
            ]);
        } else {
            \App\Models\Profile::create([
                'user_id' => \Auth::id(),
                'name_en' => $this->name_en,
                'personal_photo' => $this->personal_photo->store('profile', 'public'),
                'deposit_photo' => $this->deposit_photo?->store('profile', 'public'),
                'national_photo' => $this->national_photo->store('profile', 'public'),
                'address' => $this->address,
                'postel_code' => $this->postel_code
            ]);
        }

        session()->flash('message', 'تکمیل ثبت نام شما با موفقیت انجام شد!');

        $this->profile = \App\Models\Profile::where('user_id', \Auth::id())->first();
        $this->name_en = null;
        $this->personal_photo = null;
        $this->deposit_photo = null;
        $this->national_photo = null;
        $this->address = null;
        $this->postel_code = null;
    }
}
