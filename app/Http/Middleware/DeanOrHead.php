<?php

namespace App\Http\Middleware;

use Closure;
use App\Department;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Registered as "DeanOrHead"

class DeanOrHead
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
            
            if ((Auth::user()->type == 'dean') || (Auth::user()->type == 'lecture' && Department::where('department_head_employee_id', Auth::user()->user_name)->first())) {
                return $next($request);
            }else{
                return back()->with('warning','Unauthorized page.');
            }
        }
    }
}


