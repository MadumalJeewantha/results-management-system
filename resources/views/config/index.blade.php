@extends('layouts.config')

@section('content')

    <div class="alert alert-warning" style="margin-top:10px">
        Before using the Results Management System you have to do some configurations. This won't take long time.            
    </div>

    <div class="jumbotron ">
        <h2><span class="glyphicon glyphicon-cog"></span> Configurations</h2>
        <hr>
        <h3><strong><span class="badge badge-primary badge-pill">1</span> Deans profile creation</strong></h3>
        <p>The dean of faculty is the highest responsible person. As a dean you have all controls over the Results Management System.</p>
        <p>To procured functions of the system first create Deans profile.</p>


                {{-- Registration form --}}
        
                           
                            <div class="panel-body">
                                {!! Form::open(['action' => 'ConfigurationsController@register', 'method'=>'POST' , 'class' => 'form-horizontal' ]) !!}
                                {{-- <form class="form-horizontal" method="POST" action="{{ route('register') }}"> --}}
                                    {{ csrf_field() }}
                                    
                                    {{-- Name input --}}
                                    <input type="hidden" id="name" name="name" value="Dean Faculty of Management Studies &amp; Commerce">

                                    {{-- Type input --}}
                                    <input type="hidden" id="type" name="type"  value="dean">

                                    {{-- User Name --}}
                                    <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                                        <label for="user_name" class="col-md-4 control-label">User Name</label>
            
                                        <div class="col-md-6">
                                            <input id="user_name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" required autofocus>
            
                                            @if ($errors->has('user_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('user_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                   
                                    
                                    {{-- Email --}}
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    {{-- Password --}}
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required>
            
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
            
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
            
            
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Create
                                            </button>
                                        </div>
                                    </div>
                                {{-- </form> --}}
                  {!! Form::close() !!}
                            </div>
              
            {{-- end registration form --}}
    </div>
 @endsection     