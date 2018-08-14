<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == 'customer'){
            $sCheck = session('area');
            if(!isset($sCheck) &&  !in_array($request->url(), [url('/choose-country'), url('/login')])){
                return redirect()
                    ->to('/choose-country');
            }else{
                return $next($request);
            }
        }elseif(Auth::check() && Auth::user()->role == 'driver'){
            return redirect('/d');
        }elseif(Auth::check() && Auth::user()->role == 'super-admin'){
            return redirect('/admin');
        }else{
            return redirect('');
        }
    }
}
