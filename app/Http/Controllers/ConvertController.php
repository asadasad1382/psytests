<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class ConvertController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('tests')) {
            $this->uploadsTest();
        }
        if ($request->has('questions')) {
            $this->uploadsQuestions();
        }

    }

    private function uploadsTest()
    {
        $tests = \DB::connection('mysql_old')->table('tests')->get();
        foreach ($tests as $test) {
            Test::create([
                'id' => $test->id + 23,
                'category_id' => 4,
                'name' => $test->TName,
                'number_of_question' => $test->NOQ,
                'default' => $test->be_default,
                'random' => $test->random,
                'time' => $test->time,
                'rtl' => $test->rtl,
                'minus_mark' => $test->minus_mark,
                'show_rank' => $test->show_rank,
                'show_answers' => $test->show_answers,
                'show_mark' => $test->show_mark,
                'active' => $test->active,
                'start_message' => $test->start_message,
                'end_message' => $test->end_message,
            ]);
        }
    }

    private function uploadsQuestions()
    {
        $questions = \DB::connection('mysql_old')->table('questions')->get();

        foreach ($questions as $question) {
            Question::create([
                'test_id' => $question->test_id + 23,
                'question' => $question->question,
                'choice1' => $question->choice1,
                'choice2' => $question->choice2,
                'choice3' => $question->choice3,
                'choice4' => $question->choice4,
                'answer' => $question->answer,
                'random' => $question->random,
                'long_answer' => $question->long_answer,
            ]);
        }

    }
}
