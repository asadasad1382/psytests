<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UserChoice;
use App\Http\Controllers\CourseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/courses',[CourseController::class,'crawl']);
Route::get('/updateapp', function()
{
    \Artisan::call('dump');
    echo 'dump-autoload complete';
});


Route::get('/result',function (Request $request){
           $id = $request->query('id');
                   $user_test = \App\Models\UserTest::find($id);

                           $answers = UserChoice::where('user_test_id',$user_test->id)->get();
                foreach ($answers as $answer) {

                        $result[strval($answer->question['page_id'] + 1)] = [
                          'max' => $answer['answer'],
                          'min' => $answer['answer2']
                        ];

                }

                $result = serialize($result);
           $data = Http::withHeaders([
            'token' => env('SINATIK_TOKEN'),
            'results' => $result
        ])->post('https://sinatik.com/api/detail',[
            'username' => $user_test->username ?? session('test_username')
        ])->json()['datas'];

        $pdf = $data['pdf'];
        if (!\Auth::user()->can('view', $user_test)) {
            return abort(403, 'شما مجاز با دیدن این بخش نیستید!');
        }
        return redirect()->to($pdf);
})->name('result');
Route::get('/', function () {
    return redirect(\route('login'));
});

Route::middleware(['auth:admin','rtl-licence'])->prefix('wa-admin')->name('admin.')->group(function () {
    Route::get('/', \App\Http\Livewire\Admin\Dashboard::class)->name('dashboard');
    Route::get('categories', \App\Http\Livewire\Admin\Categories::class)->name('categories');
    Route::get('tests', \App\Http\Livewire\Admin\Tests::class)->name('tests');
    Route::get('users_tests', \App\Http\Livewire\Admin\UserTests::class)->name('users_tests');
    Route::get('user_test/{id}', \App\Http\Livewire\Admin\UserTest::class)->name('user_test');
    Route::get('questions', \App\Http\Livewire\Admin\Questions::class)->name('questions');
    Route::get('users', \App\Http\Livewire\Admin\Users::class)->name('users');
    Route::get('admins', \App\Http\Livewire\Admin\Admins::class)->name('admins');
    Route::get('settings', \App\Http\Livewire\Admin\Settings::class)->name('settings');
    Route::get('storage', function () {
        Artisan::call('storage:link');
        return to_route('admin.dashboard');
    });

});

Route::middleware(['auth', 'activeUser'])->prefix('panel')->name('panel.')->group(function () {
    Route::get('/', \App\Http\Livewire\Panel\Dashboard::class)->name('dashboard');
    Route::get('categories', \App\Http\Livewire\Panel\Categories::class)->name('categories');
    Route::get('tests/{category_id}', \App\Http\Livewire\Panel\Tests::class)->name('tests');
    Route::get('test/{id}', \App\Http\Livewire\Panel\Test::class)->name('test');
    Route::get('user_tests', \App\Http\Livewire\Panel\UserTests::class)->name('user_tests');
    Route::get('user_test/{id}', \App\Http\Livewire\Panel\UserTest::class)->name('user_test');
    Route::get('profile', \App\Http\Livewire\Panel\Profile::class)->name('profile');

});

Route::prefix('auth')->group(function () {
    Route::get('login', \App\Http\Livewire\Auth\Login::class)->name('login');
    Route::get('forgot-password', \App\Http\Livewire\Auth\Forgot::class)->name('forgot');
    Route::get('register', \App\Http\Livewire\Auth\Register::class)->name('register');
    Route::get('logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        \Illuminate\Support\Facades\Auth::guard('admin')->logout();
        return back();
    })->name('logout')->withoutMiddleware('guest');
});

Route::any('callback/{session}', [\App\Http\Controllers\CallbackController::class, 'index'])->name('callback');

Route::get('convert', [\App\Http\Controllers\ConvertController::class, 'index']);
