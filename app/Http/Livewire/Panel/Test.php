<?php

namespace App\Http\Livewire\Panel;

use App\Helper\Helper;
use App\Http\Livewire\Breadcrumb;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\UserChoice;
use App\Models\UserTest;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use App\Models\User;
class Test extends Component
{
    use Breadcrumb, WithPagination;

    public $questions = [], $test, $user_test, $user_test_count, $ip, $agent, $answers = [],$answers2 = [], $timer
    ,$page_id = 1,$test_username;

    public function mount($id)
    {

        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'شروع آزمون'
        ];
        $this->test = \App\Models\Test::findOrFail($id);
        $this->user_test_count = UserTest::where('user_id', \Auth::id())->where('test_id', $id)->count();
        $this->ip = request()->ip();
        $this->agent = request()->userAgent();
        $this->checkUserTest();
        if ($this->user_test_count >= 3) {
            $this->addError('startTest', 'تعداد دفعات آزمون شما با تمام رسیده است');
        }

        if ($this->user_test) {
            $this->timerStart();
        }
    }

    public function render()
    {
        return view('livewire.panel.test')
            ->extends('layouts.panel.master')->section('main');
    }

    public function start()
    {
        if ($this->user_test_count >= 3 && Setting::get('testLimit')) {
            $this->addError('startTest', 'تعداد دفعات آزمون شما با تمام رسیده است');
            return;
        }
        $this->user_test = UserTest::create([
            'user_id' => \Auth::id(),
            'test_id' => $this->test->id,
            'ip_address' => $this->ip,
            'finish' => 0,
            'browser' => $this->agent,
            'username' => $this->test_username
        ]);
        $this->user_test_count++;
        $this->questions = $this->getQuestions();
        $this->timerStart();
    }

    private function getQuestions()
    {

        $count = Question::where('test_id', $this->test->id)->count();
        $randomCount = $count > $this->test->number_of_question ? $this->test->number_of_question : $count;
        $questions = Question::where('test_id', $this->test->id)->get()->random($randomCount);
        foreach ($questions as $question) {
            array_push($this->answers, [
                'user_test_id' => $this->user_test->id,
                'page_id' => $question->page_id,
                'question_id' => $question->id,
                'answer' => null
            ]);
        }
        return $questions;
    }

    public function end()
    {
                $this->timerStart();
                $result = [];

                if ($this->timer > 0) {
                    foreach ($this->answers as $answer) {
                        UserChoice::create($answer);

                        $result[strval($answer['page_id'] + 1)] = [
                          'max' => $answer['answer'],
                          'min' => $answer['answer2']
                        ];

                    }
                    $result = serialize($result);
                    session(['test_result' => $result]);
                    $this->user_test->update([
                        'finish' => 1,
                        'time_length' => now()->diffInMinutes($this->user_test->created_at)
                    ]);
                } else {
                    $this->user_test->update([
                        'finish' => 1,
                        'time_length' => now()->diffInMinutes($this->user_test->created_at)
                    ]);
                    $this->addError('endTest', 'زمان آزمون به پایان رسیده است');
                }



    }

    public function changeAnswer($key, $value)
    {
        $this->answers[$key]['answer'] = $value;
    }

    private function timerStart()
    {
        if(! isset($this->user_test) )
         $this->user_test = UserTest::where('user_id', \Auth::id())
            ->where('test_id', $this->test->id)
            ->where('finish', 0)
            ->first();

        $this->timer = $this->test->time - now()->diffInMinutes($this->user_test->created_at);
        $this->dispatchBrowserEvent('timer-start');
    }

    public function updatedAnswers()
    {
        $this->checkUserTest();
        $this->timerStart();
    }

    private function checkUserTest()
    {
        $userTest = UserTest::where('user_id', \Auth::id())
            ->where('test_id', $this->test->id)
            //->where('finish', '==', 0)
            ->first();
        if ($userTest) {
            if (now()->diffInMinutes($userTest->created_at) < $this->test->time) {
                $this->user_test = $userTest;
                if (count($this->questions) == 0) {
                    $this->questions = $this->getQuestions();
                }
            } else {
                $this->end();
            }
        }
    }

    public function payment()
    {

            \DB::transaction(function () {
                $amount = $this->test->price;


                if(auth()->user()->paid_all == 0){

                    $invoice = (new Invoice)->amount($amount);
                    $payment = Payment::callbackUrl(
                        route('callback',['session' => $this->test->id ])
                    )->purchase(
                        $invoice,
                        function ($driver){

                        }
                    )->pay()->toJson();

                    $response = json_decode($payment, true);
                                    return redirect($response['action']);

                }else{
                    $transaction = Transaction::create([
                        'user_id' => \Auth::id(),

                        'amount' => intval($this->test->price),
                        'test_id' => $this->test->id,
                        'description' => 'پرداخت بابت تمدید آزمون'
                    ]);


                    $user = User::where('id',$transaction->user_id)->first();
                    $response = Http::withHeaders([
                            'token' => env('SINATIK_TOKEN')
                        ])->post('https://sinatik.com/api/buytest',[
                     'products' => [['productid' => $this->test->type_id, 'count' => 1]],
                     'email' => auth()->user()->mobile
                    ])->json();

                    $transaction->status = 'paid';


                    $transaction->save();

                    $user_name = $response['datas'][0]['usernames'][0];
                    $this->test_username = $user_name;
                    session(['test_username' => $user_name]);

                }

                session(['test_id' => $this->test->id]);

            });
    }
}
