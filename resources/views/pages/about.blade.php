@extends('layouts.app')

@section('content')

{{-- style="opacity: 0.5;"
 --}}
<div class="jumbotron" style="background-color:rgba(255,255,255, 1)">
<h2>About</h2>
<hr>
<p>This is the official web site, <strong>"Results Management System"</strong> of Faculty of Management Studies and Commerce, University of Jaffna.</p>
<p>The website originally developed to enhance the usability of undergraduates for the calculation of GPA, define subjects & result related purposes.</p>
<p>The purpose of the Results Management System is to enhance the reliability of the results issued by the authority of the university of Jaffna.</p>

    @if(Auth::guest())
         <p>Please login with your logging credentials.</p>
    @endif
</div>
 @endsection     