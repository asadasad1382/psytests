<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;

class Breadcrumb extends Component
{
    public $links = [];

    protected $listeners = ['setLinks' => 'updateLinks'];

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.admin.components.breadcrumb');
    }

    public function updateLinks($links)
    {
        $this->links = $links;
    }
}
