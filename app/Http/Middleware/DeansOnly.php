<?php

namespace App\Http\Middleware;

use Closure;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


// Registered as "deansonly"
class DeansOnly
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
           //Get user type
            $type = Auth()->user()->type;

           if($type != 'dean'){
                //redirect    
                return back()->with('warning','Unauthorized page.');
           }
       }
       //Allow access to the request
       return $next($request);
    }
}
