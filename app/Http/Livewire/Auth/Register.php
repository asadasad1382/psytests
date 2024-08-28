<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Hash;

class Register extends Component
{
    public $first_name, $last_name, $father_name, $user_name, $mobile, $password
    ,$password_confirmation,$birthday,$gender = "زن",$reshteh,$province_id = 1;

    public function render()
    {
        $provinces = [
            [ 'id' => 1,'value' => 'آذربایجان شرقی'],
            [ 'id' => 2,'value' => 'آذربایجان غربی'],
            [ 'id' => 3,'value' => 'اردبیل'],
            [ 'id' => 4,'value' => 'اصفهان'],
            [ 'id' => 5,'value' => 'البرز'],
            [ 'id' => 6,'value' => 'بوشهر'],
            [ 'id' => 7,'value' => 'تهران'],
            [ 'id' => 8,'value' => 'چهارمحال بختیاری'],
            [ 'id' => 9,'value' => 'خراسان جنوبی'],
            [ 'id' => 10,'value' => 'خراسان رضوی'],
            [ 'id' => 11,'value' => 'خراسان شمالی'],
            [ 'id' => 12,'value' => 'خوزستان'],
            [ 'id' => 13,'value' => 'زنجان'],
            [ 'id' => 14,'value' => 'سمنان'],
            [ 'id' => 15,'value' => 'سیستان بلوچستان'],
            [ 'id' => 16,'value' => 'فارس'],
            [ 'id' => 17,'value' => 'قزوین'],
            [ 'id' => 18,'value' => 'قم'],
            [ 'id' => 19,'value' => 'کردستان'],
            [ 'id' => 20,'value' => 'کرمان'],
            [ 'id' => 21,'value' => 'کرمانشاه'],
            [ 'id' => 22,'value' => 'کهگیلویه و بویراحمد'],
            [ 'id' => 23,'value' => 'گلستان'],
            [ 'id' => 24,'value' => 'گیلان'],
            [ 'id' => 25,'value' => 'لرستان'],
            [ 'id' => 27,'value' => 'مازندران'],
            [ 'id' => 28,'value' => 'مرکزی'],
            [ 'id' => 29,'value' => 'هرمزگان'],
            [ 'id' => 30,'value' => 'همدان'],
            [ 'id' => 31,'value' => 'یزد'],
        ];

        return view('livewire.auth.register',['provinces' => $provinces])
            ->extends('layouts.admin.master')->section('main');
    }

    public function register()
    {
        $validateDate = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'user_name' => 'required|unique:users,user_name',
            'mobile' => 'required|unique:users,mobile',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'province_id' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'reshteh' => 'required'
        ]);


        $validateDate['password'] = \Hash::make($validateDate['password']);

        $response = Http::withHeaders([
            'token' => env('SINATIK_TOKEN')
        ])
            ->post('https://sinatik.com/api/createUser',[
            'fname' => $validateDate['first_name'],
            'lname' => $validateDate['last_name'],
            'mobile' => $validateDate['mobile'],
            'password' => $validateDate['password'],
            'province_id' => $validateDate['province_id'],
            'gender' => $validateDate['gender'],
            'birthday' => $validateDate['birthday'],
            'reshteh' => $validateDate['reshteh'],
            'job_category_id' => 7,
            'blood_group' => 9,
            'education' => 2,
            'email' => $validateDate['mobile'],
            'weight' => 60,
            'height' => 170,
            'married' => 'مجرد'

        ]);

        if($response->json()['status'] == 200) {
            User::create($validateDate);
            $this->reset();
            session()->flash('message', 'ثبت نام با موفقیت انجام شد! منتظر تائید مدیر بمانید نتیجه فعال سازی از سمت مدیر برای شما ارسال میگردد');
            return redirect(route('login'));    
        }else{
            $this->addError('duplicate',"<a>dasds</a>");
        }

    }
}
