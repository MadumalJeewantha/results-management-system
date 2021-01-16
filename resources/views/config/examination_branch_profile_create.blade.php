@extends('layouts.app')

@section('content')

    <div class="alert alert-warning" style="margin-top:10px">
        Before using the Results Management System you have to do some configurations. This won't take long time.            
    </div>

    <div class="jumbotron ">
        <h2><span class="glyphicon glyphicon-cog"></span> Configurations</h2>
        <hr>
        <h3><strong><span class="badge badge-primary badge-pill">3</span> Examination Branch profile creation</strong></h3>
        <p>Examination branch act as independent place to manage all examination activities.</p>
        <p>Password will be sent in an email.</p>
        

                {{-- Registration form --}}        
                           
                            <div class="panel-body">
                                {!! Form::open(['action' => 'ConfigurationsController@register', 'method'=>'POST' , 'class' => 'form-horizontal' ]) !!}
                                    
                                    {{-- Name input --}}
                                    <input type="hidden" id="name" name="name" value="Examination Branch University of Jaffna">

                                    {{-- Type input --}}
                                    <input type="hidden" id="type" name="type"  value="examination_branch">

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
                                    {{-- generate password for examination branch  --}}
                                <input type="hidden" id="password" name="password" value="{{str_random(20)}}">

            
            
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Create
                                            </button>
                                        </div>
                                    </div>

                        {!! Form::close() !!}
                  
                            </div>
              
            {{-- end registration form --}}
    </div>
 @endsection     