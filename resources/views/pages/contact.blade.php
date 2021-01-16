@extends('layouts.app')

@section('content')

<div class="jumbotron" style="background-color: rgba(255,255,255, 1)">
    <h2>Contact Us</h2>
    <hr>             
    <p >Feel free to give your feedback to us. It will help to improve our service.</p>
    
    <!-- Contact Form -->
    {!! Form::open(['action' => 'ContactsController@store', 'method'=>'POST']) !!}
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {{Form::text('name', '' ,['class'=>'form-control','placeholder'=> 'Your Name' ,'required'])}}
            </div>
        </div>
    
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {{Form::email('email', '' ,['class'=>'form-control','placeholder'=> 'Your Email' ,'required'])}}
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                {{Form::text('subject', '' ,['class'=>'form-control','placeholder'=> 'Subject' ,'required'])}}
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class="form-group">
                {{Form::textarea('message', '' ,['class'=>'form-control','placeholder'=> 'Message' ,'style' => 'height:150px','required'])}}
            </div>
        </div>
           
    {{Form::submit('Send Message',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

</div>
            
 @endsection     