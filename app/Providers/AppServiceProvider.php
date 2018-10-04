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
            }
        });
        View::share('img', User_data::find(Auth::id()));
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
