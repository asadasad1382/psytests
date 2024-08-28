<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Breadcrumb;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Pipeline\Pipeline;
use Livewire\Component;
use Livewire\WithPagination;

class Questions extends Component
{
    use Breadcrumb, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $test_id, $question_id, $question, $choice1, $choice2, $choice3, $choice4, $random = 1, $long_answer, $answer;

    public function mount()
    {
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'مدیریت آزمون ها'
        ];
    }

    public function render()
    {
        $questions = $this->getQuestions();
        $tests = Test::all();
        return view('livewire.admin.questions', compact('questions', 'tests'))
            ->extends('layouts.admin.master')->section('main');
    }

    private function getQuestions()
    {
        return app(Pipeline::class)
            ->send(Question::query())
            ->thenReturn([
                //
            ])
            ->orderBydesc('created_at')
            ->paginate();
    }

    public function edit(Question $question)
    {
        $this->question_id = $question->id;
        $this->test_id = $question->test_id;
        $this->question = $question->question;
        $this->choice1 = $question->choice1;
        $this->choice2 = $question->choice2;
        $this->choice3 = $question->choice3;
        $this->choice4 = $question->choice4;
        $this->random = $question->random;
        $this->answer = $question->answer;
        $this->long_answer = $question->long_answer;
    }

    public function store()
    {
        if ($this->question_id) {
            $question = Question::find($this->question_id);
            $question->update([
                'test_id' => $this->test_id,
                'question' => $this->question,
                'choice1' => $this->choice1,
                'choice2' => $this->choice2,
                'choice3' => $this->choice3,
                'choice4' => $this->choice4,
                'random' => $this->random,
                'answer' => $this->answer,
                'long_answer' => $this->long_answer
            ]);
        } else {
            Question::create([
                'test_id' => $this->test_id,
                'question' => $this->question,
                'choice1' => $this->choice1,
                'choice2' => $this->choice2,
                'choice3' => $this->choice3,
                'choice4' => $this->choice4,
                'random' => $this->random,
                'answer' => $this->answer,
                'long_answer' => $this->long_answer
            ]);
        }
        $this->reset();
    }

    public function destroy(Question $question)
    {
        $question->delete();
    }
}
