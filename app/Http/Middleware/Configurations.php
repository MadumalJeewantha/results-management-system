<?php

namespace App\Http\Middleware;

use App\User;
use App\Course;
use App\Department;

use Closure;

class Configurations
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

        //Check Users Table
        $users = User::all();
        if ($users->isEmpty()) {
            return redirect('config');
        }

        // //Check Courses table
        // $courses = Course::all();
        // if ($courses->isEmpty()) {
        //     return redirect('config');
        // }

        // //Check Departments table
        // $departmetns = Department::all();
        // if ($departmetns->isEmpty()) {
        //     return redirect('config');
        // }

        //5.Subjects creation 
            //Assign Subjects to course
            //Assign subjects to departments


            //6.Grading system creation

            //7.Specialized Areas creation

            //8.Academic Years creation

        return $next($request);
    }
}
