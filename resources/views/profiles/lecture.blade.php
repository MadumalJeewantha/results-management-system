@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">              
               Profile 
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
               <a href="profile/lecture/edit" class="btn btn-primary pull-right">Edit Profile</a>              
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
</div>

    <div class="row">
        
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


        {!! Form::open([ 'class'=> 'form-horizontal']) !!}

        <div class="container-fluid shadow">
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                        <div id="panel1" class="panel panel-default" data-role="panel">
                            <div class="panel-heading">Personal Details</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-6">

                                        <!--employee_id-->
                                        <div class="form-group">                                                
                                            <label class="control-label control-label-left col-sm-3" for="employee_id">Employee ID<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                            <input id="employee_id" class="form-control k-textbox" data-role="text" placeholder="Employee ID" name="employee_id" required="required"  type="text" value="{{$lecture->employee_id}}" readonly>                                                                                          
                                            </div>
                                        </div>

                                        <!--initials-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="initials">Initials<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="initials" class="form-control k-textbox" data-role="text" placeholder="Initials" name="initials" required="required"  type="text" value="{{$lecture->initials}}" readonly>                                                 
                                            </div>
                                        </div>

                                        <!--first_name-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="first_name">First Name<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="first_name" class="form-control k-textbox" data-role="text" placeholder="First Name" name="first_name" required="required" type="text" value="{{$lecture->first_name}}" readonly>                                    
                                            </div>
                                        </div>

                                        <!--last_name-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="last_name">Last Name</label>
                                            <div class="controls col-sm-9">
                                                <input id="last_name" class="form-control k-textbox" data-role="text" placeholder="Last Name" name="last_name" type="text" value="{{$lecture->last_name}}" readonly>
                                            </div>
                                        </div>

                                        <!--email-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="email">Email<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                    <input id="email" class="form-control k-textbox" data-role="text" placeholder="Email Address" name="email" type="text" value="{{$lecture->email}}" readonly>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="col-md-6">

                                        <!--department_id-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="department_name">Department <span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="department_name" class="form-control k-textbox" data-role="text" placeholder="Department Name" name="department_name" type="text" value="{{$lecture->department->name}}" readonly> 
                                            </div>
                                        </div>

                                        <!--mobile-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="mobile">Mobile</label>
                                            <div class="controls col-sm-9">
                                                <input id="mobile" class="form-control k-textbox" data-role="text" placeholder="Mobile Number" name="mobile" type="text" value="{{$lecture->mobile }}" readonly>
                                         </div>
                                        </div>

                                        <!--gender-->
                                        <div class="form-group" style="display: block;">
                                            <label class="control-label control-label-left col-sm-3">Gender<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                    @if($lecture->gender == 'Male')
                                                        <label class="radio" for="male">
                                                            <input value="Male" id="male" name="gender" required="required" checked="checked" type="radio">
                                                            Male
                                                        </label>
                                                    @else
                                                        <label class="radio" for="female">
                                                            <input value="Female" id="female" name="gender" required="required" checked="checked" type="radio">
                                                            Female
                                                        </label>
                                                    @endif
                                            </div>                                                                                        
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="panel2" class="panel panel-default" data-role="panel">
                            <div class="panel-heading">Quelification Details</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <!--qualifications-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="qualifications">Qualifications</label>
                                            <div class="controls col-sm-9">
                                                <textarea id="qualifications" placeholder="Tell about your qualifications" rows="3" class="form-control k-textbox" data-role="textarea" name="qualifications" style="height: 182px;" readonly> {{$lecture->qualifications}} </textarea>                                            
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="panel3" class="panel panel-default" data-role="panel">
                            <div class="panel-heading">Profile Picture</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <!--image thumbnail-->
                                        <div class="form-group">
                                            <div class="controls col-sm-9">
                                                <img class="img-fluid img-thumbnail p-3" id="uploadPreview" src="{{ $lecture->profile_picture}}" alt="Profile Picture"> 
                                            </div>
                                        </div>                                                                            

                                    </div>

                                    <!--bio-->
                                    <div class="col-md-5">
                                        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="bio">Bio</label>
                                            <div class="controls col-sm-9">
                                            <textarea id="bio" rows="8" class="form-control k-textbox"   placeholder="Tell about yourself" name="bio" type="text" readonly> {{$lecture->bio}}</textarea>                                                                        
                                            </div>                                       
                                        </div>

                                        <div> 
                                            <br> 
                                            <a href="/dashboard" class="btn btn-default pull-right" > Back</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>                                
                    </div>
                </div>

            </div>
        </div>

        {!!Form::close()!!}

    </div>
</div>




@endsection