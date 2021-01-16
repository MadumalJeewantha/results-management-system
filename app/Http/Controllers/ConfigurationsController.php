<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmailJob;



class ConfigurationsController extends Controller
{
    public function config()
    {
        //Check Users Table: To protect directly entering config url even when data are filled
        $users = User::all();
        if (!$users->isEmpty()) {
            return back()->with('warning', 'Unauthorized action.');
        }

        //return index page of configurations - deans profile creation
        //Before Auth
        return view('config.index');
    }

    //User registration dean & ar
    public function register(Request $request)
    {

        //Validation
        if ($request->type == 'dean') {
            $this->validate($request, [
                'user_name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
        } elseif ($request->type == 'ar') {
            $this->validate($request, [
                'user_name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        } elseif ($request->type == 'examination_branch') {
            $this->validate($request, [
                'user_name' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }

        //user creation
        $user = new User;
        $user->user_name = $request->input('user_name');
        $user->name = $request->input('name');
        $user->type = $request->input('type');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        //Redirection with message
        if ($request->type == 'dean') {

            $msg = "Congratulations, Deans profile created. All the functions are under your control.";
            $this->guard()->login($user);
            return redirect('/dashboard')->with('success', $msg);

        } elseif ($request->type == 'ar') {
            
            //Send email            
            SendEmailJob::dispatch($request->all());
            // dispatch(new SendEmailJob($request));

            
            $msg = "Assistant Registrar profile created. Password has been sent to " . $request->email;
            return redirect('/dashboard')->with('success', $msg);
            // return redirect()->action('DashboardController@index');

        } elseif ($request->type == 'examination_branch') {

            //Send email
            SendEmailJob::dispatch($request->all());
            // dispatch(new SendEmailJob($request));

            $msg = "Examination Branch profile created. Password has been sent to " . $request->email;
            return redirect('/dashboard')->with('success', $msg);
            // return redirect()->action('DashboardController@index');

        }

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
