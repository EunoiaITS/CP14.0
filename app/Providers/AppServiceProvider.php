<?php

namespace App\Providers;

use App\Notifications;
use App\User_data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function($view) {
            if(auth()->check()){
                $view->with('notify', Notifications::where('to', auth()->user()->id)
                    ->where(['status' => 'unread'])
                    ->orderBy('id', 'desc')
                    ->get()
                );
                if(Auth::user()->role != 'super-admin'){
                    $id = Auth::user()->id;
                    $usd = User_data::where('user_id',$id)->first();
                    View::share('img', $usd->picture);
                }
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		//
    }
}
