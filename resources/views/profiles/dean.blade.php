@extends('layouts.dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Profile <a href="/dashboard" class="btn btn-default pull-right">Back</a>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-heart"></i> Profile
                    </li>                     
                </ol>
        </div>



    <div class="col-lg-12">
            {{-- Change password --}}
            <div class="panel panel-default">
                    <div class="panel-heading">Change password</div>
     
                    <div class="panel-body">                        
                            <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                            {{-- {!! Form::open(['action' => ['ProfilesController@changePassword' , $user->user_name], 'method'=>'POST' , 'class' => 'form-horizontal' ]) !!} --}}
                            {{ csrf_field() }}
     
                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>
     
                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>
     
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
     
                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>
     
                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>
     
                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
     
                            <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
     
                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>
     
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
                

                {{-- Change personal details --}}
                <div class="panel panel-default">
                        <div class="panel-heading">Personal Details</div>
         
                        <div class="panel-body">
                                {!! Form::open(['action' => ['ProfilesController@updatePersonalDetails', $user->user_name] , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
         
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Display Name</label>
         
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required>
         
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
         
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email</label>
         
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>
         
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>         
         
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Change
                                        </button>
                                    </div>
                                </div>
                            {{Form::hidden('_method', 'PUT')}}
                            {!! Form::close() !!}
                        </div>
                    </div>

    </div>        

    
@endsection