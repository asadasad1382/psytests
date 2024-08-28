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
use Livewire\WithPagination;

class Tests extends Component
{
    use Breadcrumb, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $test_id, $category_id, $default = 0, $name, $number_of_question, $random = 0, $time, $rtl = 1, $minus_mark = 0, $show_answers = 0,
        $show_mark = 0, $show_rank = 0, $active = 1, $start_message, $end_message;

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'مدیریت آزمون ها'
        ];
    }

    public function render()
    {
        $tests = $this->getTests();
        $categories = Category::all();
        return view('livewire.admin.tests', compact('tests', 'categories'))
            ->extends('layouts.admin.master')->section('main');
    }

    private function getTests()
    {
        return app(Pipeline::class)
            ->send(Test::query())
            ->thenReturn([
                //
            ])
            ->orderBydesc('created_at')
            ->paginate();
    }

    public function edit(Test $test)
    {
        $this->category_id = $test->category_id;
        $this->name = $test->name;
        $this->number_of_question = $test->number_of_question;
        $this->random = $test->random;
        $this->time = $test->time;
        $this->rtl = $test->rtl;
        $this->minus_mark = $test->minus_mark;
        $this->show_answers = $test->show_answers;
        $this->show_mark = $test->show_mark;
        $this->show_rank = $test->show_rank;
        $this->active = $test->active;
        $this->start_message = $test->start_message;
        $this->end_message = $test->end_message;
    }

    public function store()
    {
        if ($this->test_id) {
            $test = Test::find($this->test_id);
            $test->update([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'number_of_question' => $this->number_of_question,
                'random' => $this->random,
                'time' => $this->time,
                'rtl' => $this->rtl,
                'minus_mark' => $this->minus_mark,
                'show_answers' => $this->show_answers,
                'show_mark' => $this->show_mark,
                'show_rank' => $this->show_rank,
                'active' => $this->active,
                'start_message' => $this->start_message,
                'end_message' => $this->end_message
            ]);
        } else {
            Test::create([
                'category_id' => $this->category_id,
                'name' => $this->name,
                'number_of_question' => $this->number_of_question,
                'random' => $this->random,
                'time' => $this->time,
                'rtl' => $this->rtl,
                'minus_mark' => $this->minus_mark,
                'show_answers' => $this->show_answers,
                'show_mark' => $this->show_mark,
                'show_rank' => $this->show_rank,
                'active' => $this->active,
                'start_message' => $this->start_message,
                'end_message' => $this->end_message
            ]);
        }
        $this->reset();
    }

    public function destroy(Test $test)
    {
        try {
            \DB::transaction(function () use ($test) {
                $userTests = UserTest::where('test_id', $test->id)->get();
                foreach ($userTests as $userTest) {
                    UserChoice::where('user_test_id', $userTest->id)->delete();
                    $userTest->delete();
                }
                Question::where('test_id', $test->id)->delete();
                $test->delete();
            });
        } catch (\Exception $exception) {
            \DB::rollBack();
        }
    }
}
