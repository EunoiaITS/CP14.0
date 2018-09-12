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
<<<<<<< HEAD
        if(!isset($sCheck) &&  !in_array($request->url(), [url('/choose-country'), url('/login'),url('/login/admin')])){
=======
        if(!isset($sCheck) &&  !in_array($request->url(), [url('/choose-country'), url('/login'), url('/read-notification')])){
>>>>>>> 868b0e4fc79911d7ce1ffd72c02108f221cc0532
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
