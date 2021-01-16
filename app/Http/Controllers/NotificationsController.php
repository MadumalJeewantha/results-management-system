<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NotificationsController extends Controller
{
    public function markAsReadAll(){
       Auth::user()->unreadNotifications->markAsRead();

       return redirect()->back();
    }

    //Not used
    // public function markAsRead(Request $request){

    //     DB::table('notifications')
    //         ->where('id', $request->id)
    //         ->update(['read_at' => now()]);
      
    //    return redirect("/grades/". Auth::user()->user_name);
    // }
}
