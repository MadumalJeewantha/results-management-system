<?php

namespace App\Http\Middleware;

use Closure;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Registered as "ARorDean"

class ARorDean
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
        if(!(Auth::check())){
            return redirect('/login')->with('warning','Unauthorized page. Please login with your credentials');
        }else{
            $type = Auth()->user()->type;
            
            if( $type == 'dean' || $type == 'ar') {
                return $next($request);
            }else{
                return back()->with('warning','Unauthorized page.');
            }
        }
        // return $next($request);
    }
}
