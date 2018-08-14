<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Driver
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
        if(Auth::check() && Auth::user()->role == 'driver'){
            $sCheck = session('area');
            if(!isset($sCheck) &&  !in_array($request->url(), [url('/choose-country'), url('/login')])){
                return redirect()
                    ->to('/choose-country');
            }else{
                return $next($request);
            }
        }elseif(Auth::check() && Auth::user()->role == 'customer'){
            return redirect('/d');
        }elseif(Auth::check() && Auth::user()->role == 'super-admin'){
            return redirect('/admin');
        }else{
            return redirect('');
        }
    }
}
