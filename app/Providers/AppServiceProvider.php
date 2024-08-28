<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\User;
use App\Observers\WPPostObserver;
use App\Observers\WPUserObserver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $user = User::find(10);
//        $user->update([
//            'password' => Hash::make($user->user_name)
//        ]);
//        User::whereIn('id',[1,2])->get()->map(function ($user) {
//            $user->update([
//                'password' => Hash::make('123654789')
//            ]);
//        });

    }
}
