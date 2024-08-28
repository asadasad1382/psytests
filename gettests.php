<?php
    use App\Models\Question;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Arr;

    $page = 1;
    $total_pages = 2;
    $username = 'C7QLCCCLAD75AQ55';

    $questions = array();

    do {
        $response = Http::withHeaders([
            'token' => env('SINATIK_TOKEN')
        ])
            ->post('https://sinatik.com/api/questions', [
                'page' => $page,
                'username' => $username
            ])->json();
        $total_pages = $response['all_pages'];
        $page ++;

        array_push($questions,$response['questions']);
    }while($page <= $total_pages);


    foreach($questions as $page_id => $page_data){
            Question::create([
                'question' => ' ',
                'test_id' => 1,
                'choice1' => $page_data[0]['title'],
                'choice2' => $page_data[1]['title'],
                'choice3' => $page_data[2]['title'],
                'choice4' => $page_data[3]['title'],
                'answer' => 1,
                'page_id' => $page_id,
                'sinatik_id' => json_encode(Arr::pluck($page_data,'id'))
            ]);
    }

?>
