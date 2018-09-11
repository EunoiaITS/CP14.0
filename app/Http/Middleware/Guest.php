<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Guest
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
        $sCheck = session('area');
        if(!isset($sCheck) &&  !in_array($request->url(), [url('/choose-country'), url('/login'), url('/read-notification')])){
            if(Auth::check() && Auth::user()->role == 'super-admin'){
                return $next($request);
            }else{
                return redirect()
                    ->to('/choose-country');
            }
        }else{
            return $next($request);
        }
    }
}
