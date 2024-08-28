<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Breadcrumb;
use App\Models\Category;
use App\Models\Question;
use App\Models\Test;
use App\Models\UserChoice;
use App\Models\UserTest;
use Illuminate\Pipeline\Pipeline;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use PHPUnit\Exception;

class Categories extends Component
{
    use Breadcrumb, WithPagination, WithFileUploads;

    public $category_id, $title, $image, $body;

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'مدیریت دسته ها'
        ];
    }

    public function render()
    {
        $categories = $this->getCategories();
        return view('livewire.admin.categories', compact('categories'))
            ->extends('layouts.admin.master')->section('main');
    }

    private function getCategories()
    {
        return app(Pipeline::class)
            ->send(Category::query())
            ->thenReturn([
                //
            ])
            ->orderBydesc('created_at')
            ->paginate();
    }

    public function edit(Category $category)
    {
        $this->category_id = $category->id;
        $this->title = $category->title;
        $this->body = $category->body;
    }

    public function store()
    {
        if ($this->category_id) {
            $category = Category::find($this->category_id);
            $category->update([
                'title' => $this->title,
                'body' => $this->body,
                'image' => $this->image ? $this->image->store('categories', 'public') : $category->image
            ]);
        } else {
            Category::create([
                'title' => $this->title,
                'body' => $this->body,
                'image' => $this->image?->store('categories', 'public')
            ]);
        }
        $this->reset();
    }

    public function destroy(Category $category)
    {
        try {
            \DB::transaction(function () use ($category) {
                $tests = Test::where('category_id', $category->id)->get();
                foreach ($tests as $test) {
                    $userTests = UserTest::where('test_id', $test->id)->get();
                    foreach ($userTests as $userTest) {
                        UserChoice::where('user_test_id', $userTest->id)->delete();
                        $userTest->delete();
                    }
                    Question::where('test_id', $test->id)->delete();
                    $test->delete();
                }
                $category->delete();

            });
        } catch (Exception $exception) {
            \DB::rollBack();
        }

    }


}
