@extends('layouts.app')

@section('content')

    <div class="text-center">
        <div class="jumbotron text-center" style="background-color: rgba(255,255,255, 0.5); color: #11256f;">

        <img src="{{ url('storage/images/uoj.png')}}" class="img-responsive center-block animated bounceIn" alt="University of Jaffna" />
    
            <h1 class="animated fadeIn delay-1s" style="font-size:50px;">Welcome to {{config('app.name')}}</h1>
            <p class="animated fadeIn delay-2s">Faculty of Management Studies &amp; Commerce</p>
            <p class="animated fadeIn delay-2s">University of Jaffna<p>

            <p> 

                @if(Auth::guest())
                <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
                @endif
            </p>
        </div>

    </div>
 @endsection     
