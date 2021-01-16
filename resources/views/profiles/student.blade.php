@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">
                   Profile 
                   <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
                   <a href="profile/student/edit" class="btn btn-primary pull-right">Edit Profile</a>
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
     





        {!! Form::model($student, ['class'=> 'form-horizontal']) !!}

            <div class="container-fluid shadow">
                <div class="row">

                    <!--start of academic details panel-->
                    <div id="panel" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Academic Details</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <!--student_registration_number-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="student_registration_number">Registration No:<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="student_registration_number" class="form-control k-textbox" data-role="text" required="required" placeholder=" Registration  Number" name="student_registration_number" type="text" value="{{$student->student_registration_number}}" readonly>                                                                      
                                        </div>                                       
                                    </div>

                                    <!--department_id-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="department_name">Department</label>
                                        <div class="controls col-sm-9">
                                            <input id="department_name" class="form-control k-textbox" data-role="text" required="required" placeholder=" Department Name" name="department_name" type="text" value="{{$student->department->name}}" readonly>                                                                                                                           
                                        </div>
                                    </div>

                                    <!--academic_year_id-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="academic_year">Academic Year<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="academic_year" class="form-control k-textbox" data-role="text" required="required" placeholder=" Academic Year" name="academic_year" type="text" value="{{$student->academicyear->year}}" readonly>                                                                                                                                                                      
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <!--student_index_number-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="student_index_number">Index No:<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="student_index_number" required="required" class="form-control k-textbox" data-role="text" placeholder="Index Number" name="student_index_number" type="text" value="{{$student->student_index_number}}" readonly>
                                        </div>
                                    </div>

                                    <!--course_name-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="course_name">Course<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="course_name" class="form-control k-textbox" data-role="text" required="required" placeholder=" Course" name="course_name" type="text" value="{{$student->course->name}}" readonly>                                                                                                                                                                                                                
                                        </div>
                                    </div>

                                    <!--specialized_area-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="specialized_area">Specialized Area</label>
                                        <div class="controls col-sm-9">
                                            <input id="specialized_area" class="form-control k-textbox" data-role="text" required="required" placeholder=" Specialized Area" name="specialized_area" type="text" value="{{$student->specializedarea->name}}" readonly="">                                                                                                                                                                                                                                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of academic details panel-->

                    <!--start of personal details panel-->
                    <div id="panel2" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Personal Details</div>
                        <div class="panel-body">

                            <div class="row" style="display: block;">
                                <div class="col-md-6">

                                    <!--initials-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="initials">Initials<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="initials" required="required" class="form-control k-textbox" data-role="text" placeholder="Initials" name="initials" type="text" value="{{$student->initials}}" readonly>
                                        </div>
                                    </div>

                                    <!--last_name-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="last_name">Last Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="last_name" class="form-control k-textbox" data-role="text" placeholder="Last Name" name="last_name" type="text" value="{{$student->last_name}}" readonly>                                        
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="first_name">First Name<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="first_name" class="form-control k-textbox" data-role="text" required="required" placeholder="First Name" name="first_name" type="text" value="{{$student->first_name}}" readonly>                                           
                                        </div>                                        
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <!--contact_no_mobile-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="contact_no_mobile">Mobile</label>
                                        <div class="controls col-sm-9">
                                            <input id="contact_no_mobile" maxlength="10" class="form-control k-textbox" data-role="text" placeholder="Mobile Number" name="contact_no_mobile"  type="text" value="{{$student->contact_no_mobile}}" readonly>                                         
                                        </div>                                       
                                    </div>

                                    <!--contact_no_home-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="contact_no_home">Home</label>
                                        <div class="controls col-sm-9">
                                            <input id="contact_no_home" maxlength="10" class="form-control k-textbox" data-role="text" placeholder="Home Contact Number" name="contact_no_home"  type="text" value="{{$student->contact_no_home}}" readonly>                                           
                                        </div>                                       
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <!--email-->
                                    <div class="form-group" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="email">Email Address</label>
                                        <div class="controls col-sm-9">
                                            <input id="email" class="form-control k-textbox" data-role="text" placeholder="Email Address" name="email" type="text" value="{{$student->email}}" readonly>                                          
                                        </div>                                       
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <!--nic_number-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="nic_number">NIC<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="nic_number" class="form-control k-textbox" data-role="text" required="required" placeholder="National Identity Card Number" data-parsley-minwords="10" name="nic_number" type="text" value="{{$student->nic_number}}" readonly>
                                        </div>                                       
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <!--date_of_birth-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="date_of_birth">Date of Birth<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="date_of_birth" class="form-control k-textbox" data-role="text" required="required" placeholder="Date of Birth"  name="date_of_birth" type="date" value="{{$student->date_of_birth}}" readonly>
                                        </div>                                        
                                    </div>
                                </div>

                            </div>

                            <div class="row" style="display: block;">
                                <div class="col-md-6">

                                    <!--gender-->
                                    <div class="form-group" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3">Gender<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            
                                            @if($student->gender == 'Male')
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


                                <div class="col-md-6">

                                    <!--marriage_state-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3">Marriage State<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            
                                            @if($student->marriage_state == 'Married')
                                            <label class="radio" for="married">
                                                <input value="Married" id="married" name="marriage_state" checked="checked"  required="required" type="radio" >
                                                Married
                                            </label>
                                            @else
                                            <label class="radio" for="unmarried">
                                                <input value="Unmarried" id="unmarried" name="marriage_state" checked="checked" required="required" type="radio">
                                                Un-married
                                            </label>
                                            @endif
                                        </div>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of personal details panel-->

                    <!--start of address details-->
                    <div id="panel3" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Address Details</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <!--home_address_1-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="home_address_1">Home Address </label>
                                        <div class="controls col-sm-9">
                                            <input id="home_address_1" class="form-control k-textbox" data-role="text" placeholder="Number" name="home_address_1"  type="text" value="{{$student->home_address_1}}" readonly>                                          
                                        </div>                                        
                                    </div>

                                    <!--home_address_2-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="home_address_2"></label>
                                        <div class="controls col-sm-9">
                                            <input id="home_address_2" class="form-control k-textbox" data-role="text" name="home_address_2" placeholder="Street" type="text" value="{{$student->home_address_2}}" readonly>                                          
                                        </div>                                       
                                    </div>
                                    
                                    {{-- home_address_3 --}}
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="home_address_3"></label>
                                        <div class="controls col-sm-9">
                                            <input id="home_address_3" class="form-control k-textbox" data-role="text" name="home_address_3" placeholder="City" type="text" value="{{$student->home_address_3}}" readonly>                                           
                                        </div>
                                    </div>

                                    {{-- current_address_1 --}}
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="current_address_1">Current Address</label>
                                        <div class="controls col-sm-9">
                                            <input id="current_address_1" class="form-control k-textbox" data-role="text" placeholder="Number" name="current_address_1" type="text" value="{{$student->current_address_1}}" readonly>
                                        </div>                                      
                                    </div>

                                    {{-- current_address_2 --}}
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="current_address_2"></label>
                                        <div class="controls col-sm-9">
                                            <input id="current_address_2" class="form-control k-textbox" data-role="text" placeholder="Street" name="current_address_2"  type="text" value="{{$student->current_address_2}}" readonly>
                                        </div>                                        
                                    </div>
                                    
                                    {{-- current_address_3 --}}
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="current_address_3"></label>
                                        <div class="controls col-sm-9">
                                            <input id="current_address_3" class="form-control k-textbox" data-role="text" placeholder="City" name="current_address_3" type="text" value="{{$student->current_address_3}}" readonly>
                                        </div>                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of address details-->


                    <!--start of social profiles-->
                    <div id="panel4" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Social Profiles</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="fb_url">Facebook</label>
                                        <div class="controls col-sm-9">
                                            <input id="fb_url" class="form-control k-textbox" data-role="text" placeholder="Facebook Profile URL" name="fb_url" type="text" value="{{$student->fb_url}}" readonly>                                        
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="linkedin_url">Linkedin</label>
                                        <div class="controls col-sm-9">
                                            <input id="linkedin_url" class="form-control k-textbox" data-role="text" placeholder="Linkedin Profile URL" name="linkedin_url" type="text" value="{{$student->linkedin_url}}" readonly>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of social profiles-->

                    <!--start of family details-->
                    <div id="panel5" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Family Details</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <!--father_name-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="father_name">Father's Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="father_name" class="form-control k-textbox" data-role="text" placeholder="Father's Name" name="father_name"  type="text" value="{{$student->father_name}}" readonly>                                          
                                        </div>

                                    </div>

                                    <!--father_occupation-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="father_occupation">Father's Occupation</label>
                                        <div class="controls col-sm-9">
                                            <input id="father_occupation" class="form-control k-textbox" data-role="text" placeholder="Father's Occupation" name="father_occupation" value="{{$student->father_occupation}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <!--mother_name-->
                                    <div class="form-group" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="mother_name">Mother's Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="mother_name" class="form-control k-textbox" data-role="text" placeholder="Mother's Name" name="mother_name" type="text" value="{{$student->mother_name}}" readonly>
                                        </div>
                                    </div>

                                    <!--mother_occupation-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="mother_occupation">Mother's Occupation</label>
                                        <div class="controls col-sm-9">
                                            <input id="mother_occupation" class="form-control k-textbox" data-role="text" placeholder="Mother's Occupation" name="mother_occupation"  type="text" value="{{$student->mother_occupation}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <!--number_of_sisters_and_brothers-->
                                    <div class="form-group" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="number_of_sisters_and_brothers">Number of Brothers &amp; Sisters</label>
                                        <div class="controls col-sm-9">
                                            <input id="number_of_sisters_and_brothers" class="form-control k-textbox" data-role="text" placeholder="Number of Brothers &amp; Sisters" name="number_of_sisters_and_brothers"  type="text" value="{{$student->number_of_sisters_and_brothers}}" readonly>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of family details-->

                    <!--start of dissertation details-->
                    <div id="panel6" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Dissertation Details</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <!--dissertation_title-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="dissertation_title">Title</label>
                                        <div class="controls col-sm-9">
                                            <input id="dissertation_title" class="form-control k-textbox" data-role="text" placeholder="Dissertation Title" name="dissertation_title" type="text" value="{{$student->dissertation_title}}" readonly>
                                        </div>
                                    </div>

                                    <!--supervisor_name-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="supervisor_name">Supervisor</label>
                                        <div class="controls col-sm-9">
                                            <input id="supervisor_name" class="form-control k-textbox" data-role="text" placeholder="Supervisor Name" name="supervisor_name" type="text" value="{{$student->supervisor_name}}" readonly>
                                        </div>
                                    </div>

                                    <!--dissertation_published_link-->
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="dissertation_published_link">Link</label>
                                        <div class="controls col-sm-9">
                                            <input id="dissertation_published_link" class="form-control k-textbox" data-role="text" name="dissertation_published_link" placeholder="Published Link" type="text" value="{{$student->dissertation_published_link}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of dissertation details-->


                    <!--start of profile picture-->
                    <div id="panel1" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Profile Picture</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <!--image thumbnail-->
                                    <div class="form-group">
                                        <div class="controls col-sm-9">
                                            <img class="img-fluid img-thumbnail p-3" id="uploadPreview" src="{{$student->profile_picture}}" alt="Profile Picture" > 
                                        </div>
                                    </div>                                                        
                                    
                                </div>

                                <!--bio-->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label control-label-left col-sm-3" for="bio">Bio</label>
                                        <div class="controls col-sm-9">
                                        <textarea id="bio" rows="8" class="form-control k-textbox"   placeholder="Tell about yourself" name="bio" type="text" readonly> {{$student->bio}}</textarea>                                                                    
                                        </div>                                       
                                    </div>

                                    <div> 
                                        <br> 
                                        
                                    </div>
                                </div>
                            </div>
                            
                             <!--Back Button-->
                        <a href="/dashboard" class="btn btn-default pull-right" > Back</a>
                        </div>
                        
                       
                    </div>
                    <!--end of profile picture-->

                </div>
            </div>
        
        {!! Form::close() !!}

    </div>
</div>


@endsection         
