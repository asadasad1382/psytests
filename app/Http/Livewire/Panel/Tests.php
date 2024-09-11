<?php

namespace App\Http\Livewire\Panel;

use App\Filters\GlobalFilter;
use App\Http\Livewire\Breadcrumb;
use App\Models\Test;
use Illuminate\Pipeline\Pipeline;
use Livewire\Component;
use Livewire\WithPagination;

class Tests extends Component
{
    use Breadcrumb, WithPagination;

    public $category_id,$filter;
    protected $queryString = ['category_id'];

    public function mount($category_id)
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'انتخاب آزمون'
        ];
        $this->category_id = $category_id;
    }

    public function render()
    {
        $tests = $this->getTests();
        return view('livewire.panel.tests', compact('tests'))
            ->extends('layouts.panel.master')->section('main');
    }

    private function getTests()
    {
        return app(Pipeline::class)
            ->send(Test::where('active',1)->query())
            ->through([
                new GlobalFilter('name', $this->filter)
            ])
            ->thenReturn()
            ->where('category_id', $this->category_id)
            ->orderBydesc('created_at')
            ->paginate();
    }
}
