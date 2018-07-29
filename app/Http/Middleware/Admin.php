<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if(Auth::check() && Auth::user()->role == 'super-admin'){
            return $next($request);
        }elseif(Auth::check() && Auth::user()->role == 'driver'){
            return redirect('/d');
        }elseif(Auth::check() && Auth::user()->role == 'customer'){
            return redirect('/c');
        }else{
            return redirect('');
        }
    }
}
