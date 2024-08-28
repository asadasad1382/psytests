<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Breadcrumb;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use Breadcrumb, WithFileUploads;

    public $title, $logo;

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'تنظیمات'
        ];

        $this->title = Setting::get('title');
    }

    public function render()
    {
        return view('livewire.admin.settings')
            ->extends('layouts.admin.master')->section('main');
    }

    public function store()
    {
        Setting::set('title', $this->title);
        $this->logo?->storePubliclyAs('/','logo.png','public');
        session()->flash('message', 'تنظیمات با موفقیت ذخیره شد!');
    }
}
