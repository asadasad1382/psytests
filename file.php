<?php
use Illuminate\Support\Facades\Http;
use App\Models\Question;

for($i = 1;$i<=24;$i++){
    $questions = Http::withHeaders([
        'token' => '$2y$10$c7ZDde05yfGB3kMUT0yIGeNIQj1jaS/txqK3j0Tx9ixJWxq4bAv1.'
    ])->post('https://sinatik.com/api/questions', ['username' => "GLQADD00TQ", "page" => $i])->json()['questions'];

    foreach($questions as $question){

        $choice1 = 'خیلی مخالفم';
        $choice2 = 'مخالفم';
        $choice3 = 'تا حدودی';
        $choice4 = 'موافقم';
        $choice5 = 'کاملا موافقم';

        $question_id = $question['id'];
        //$data = "2,".$question['title'].",".$question['title'].","."$choice1,$choice2,$choice3,$choice4,$choice5,1,1,[$question_id],$i,0,,";
        $new_question = Question::create([
            'title' => $question['title'],
            'test_id' => 2,
            'choice1' => $choice1,
            'choice2' => $choice2,
            'choice3' => $choice3,
            'choice4' => $choice4,
            'choice5' => $choice5,
            'question' => $question['title'],
            'answer' => 1,
            'answer2' => null,
            'sinatik_id' => $question['id'],
            'page_id' => $i,
            'random' => 0,
            'long_answer' => null,
        ]);
    }


}

