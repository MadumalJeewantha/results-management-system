<?php

namespace App\Http\Middleware;

Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

// Registered as "ifLecture"
class Lecture
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
            //If the user is a lecture
            if($type == 'lecture'){
            return back()->with('warning','Unauthorized page.');
            }
        }
        return $next($request);
    }
}
