<?php

namespace App\Http\Livewire\Panel;

use App\Http\Livewire\Breadcrumb;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\UserChoice;

class UserTest extends Component
{
    use Breadcrumb;

    public $user_test,$pdf;

    public function mount($id)
    {
                $this->user_test = \App\Models\UserTest::find($id);

                $answers = UserChoice::where('user_test_id',$this->user_test->id)->get();
                foreach ($answers as $answer) {

                        $result[strval($answer['page_id'] + 1)] = [
                          'max' => $answer['answer'],
                          'min' => $answer['answer2']
                        ];

                }
                    $result = serialize($result);
        
        
        $data =dd( Http::withHeaders([
            'token' => env('SINATIK_TOKEN'),
            'results' => $result
        ])->post('https://sinatik.com/api/detail',[
            'username' => $this->user_test->username
        ])->json())['datas'];
        
        $this->pdf = $data['pdf'];
        if (!\Auth::user()->can('view', $this->user_test)) {
            return abort(403, 'شما مجاز با دیدن این بخش نیستید!');
        }
        $this->breadcrumb = [
            'link' => url()->current(),
            'title' => 'نتیجه آزمون'
        ];
    }

    public function download(){
        return redirect()->to($this->pdf);
    }

    public function render()
    {
        return view('livewire.panel.user-test')
            ->extends('layouts.panel.master')->section('main');
    }
}
