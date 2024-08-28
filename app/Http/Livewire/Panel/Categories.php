<?php

namespace App\Http\Livewire\Panel;

use App\Filters\GlobalFilter;
use App\Http\Livewire\Breadcrumb;
use App\Models\Category;
use Illuminate\Pipeline\Pipeline;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use Breadcrumb, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filter;

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'انتخاب نوع آزمون'
        ];
    }

    public function render()
    {
        $categories = $this->getCategories();
        return view('livewire.panel.categories', compact('categories'))
            ->extends('layouts.panel.master')->section('main');
    }

    private function getCategories()
    {
        return app(Pipeline::class)
            ->send(Category::query())
            ->through([
                new GlobalFilter('title', $this->filter),
                new GlobalFilter('body', $this->filter),
            ])
            ->thenReturn()
            ->orderBydesc('created_at')
            ->paginate();
    }
}
