<?php

namespace App\Http\Livewire;


trait Breadcrumb
{
    public $breadcrumb = ['link' => '', 'title' => ''];

    public function loadBreadcrumb()
    {
        $links = [
            [
                'route' => $this->breadcrumb['link'],
                'title' => $this->breadcrumb['title']
            ]
        ];
        $this->emitTo('admin.components.breadcrumb', 'setLinks', $links);
    }
}
