<?php

namespace App\Http\Livewire\License;

use App\Models\Setting;
use Livewire\Component;


class RtlLicence extends Component
{
    public $rtl_username, $rtl_password, $id_order;

    public function mount()
    {
        $this->rtl_username = Setting::get('rtl_username');
        $this->rtl_password = Setting::get('rtl_password');
        $this->id_order = Setting::get('id_order');
    }

    protected $rules = [
        'rtl_username' => 'required',
        'id_order' => 'required'
    ];

    public function render()
    {
        return view('livewire.license.rtl-licence');
    }

    public function submit()
    {
        $this->validate();
        Setting::set('rtl_username', $this->rtl_username);
        Setting::set('id_order', $this->id_order);

        $this->addError('licence', 'عملیات با موفقیت انجام شد');
        return $this->redirect('/');
    }
}
