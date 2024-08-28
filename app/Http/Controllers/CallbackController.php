<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Test;
use App\Models\Transaction;
use App\Models\UserChoice;
use App\Models\UserTest;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function index(Request $request)
    {
        try {
            $testId = $request->session;
            $status = $request->query('Status');

            $test = Test::find($testId);
            
            $transaction = Transaction::create([
                    'user_id' => \Auth::id(),

                    'amount' => intval($test->price),
                    'test_id' => $testId,
                    'description' => 'پرداخت بابت تمدید آزمون'
                ]);

            $receipt = Payment::amount($transaction->amount)->transactionId($transaction->transaction_id)->verify();
            $receipt->getReferenceId();

            $test = Test::where('id',$testId)->first();

            $user = User::where('id',$transaction->user_id)->first();
            $response = Http::withHeaders([
                    'token' => env('SINATIK_TOKEN')
                ])->post('https://sinatik.com/api/buytest',[
             'products' => [['productid' => $test->type_id, 'count' => 1]],
             'email' => $user->mobile
            ])->json();

            $transaction->status = 'paid';

            if($response['status'] != 200 || $status != "OK"){
                $transaction->status = 'new';
            }
            
            
            $transaction->save();
            
            $user_name = $response['datas'][0]['usernames'][0];
            session(['test_username' => $user_name]);
            $userTests = UserTest::where('test_id', $testId)->where('user_id', $transaction->user_id)->get();
            foreach ($userTests as $userTest) {
                UserChoice::where('user_test_id', $userTest->id)->delete();
                $userTest->delete();
            }

            return redirect(route('panel.test',['id' => $test->id] ));
        } catch (InvalidPaymentException $exception) {
            echo $exception->getMessage();
            return redirect(route('panel.test',['id' => $test->id] ));
        }
    }
}
