@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Edit Profile                 
               <a href="/profile" class="btn btn-default pull-right" style="margin:5px">Back</a>              
            </h1>
            <h4>Registration Number : <strong>{{$student->student_registration_number}}</strong></h4>
            <h4>Name : <strong>{{$student->first_name}}</strong>&nbsp;<strong>{{$student->last_name}}</strong></h4>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li>
                        <i class="glyphicon glyphicon-heart"></i>  <a href="/profile">Profile</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-pencil"></i> Edit Profile
                    </li>
                </ol>
        </div>
</div>


    <div class="row">

        {!! Form::open(['action' => ['ProfilesController@updateStudentProfile', $student->student_registration_number] , 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}

            <div class="container-fluid shadow">
                <div class="row">

                    <!--start of academic details panel-->
                    <div id="panel" class="panel panel-default" data-role="panel">
                        <div class="panel-heading">Academic Details</div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">

                                    <!--student_registration_number-->
                                    <div class="form-group{{ $errors->has('student_registration_number') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="student_registration_number">Registration No:<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="student_registration_number" class="form-control k-textbox" data-role="text" required="required" placeholder=" Registration  Number" name="student_registration_number" type="text" value="{{ $student->student_registration_number }}" readonly>
                                            <span class="help-block">Ex:2014c015</span>

                                            @if ($errors->has('student_registration_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('student_registration_number') }}</strong>
                                            </span>
                                            @endif                            
                                        </div>                                       
                                    </div>

                                    <!--department_id-->
                                    <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="department_id">Department</label>
                                        <div class="controls col-sm-9">
                                            <select id="department_id" class="form-control" data-role="select" selected="selected" name="department_id" disabled>
                                                
                                                @foreach($departments as $department)
                                                    <option value="{{$department->department_id}}" {{($department->name == $student->department->name) ? 'selected' : '' }}>
                                                        {{$department->name}}
                                                    </option>                                                
                                                @endforeach 
                                            </select>

                                            @if ($errors->has('department_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('department_id') }}</strong>
                                            </span>
                                            @endif  
                                        </div>
                                    </div>

                                    <!--academic_year_id-->
                                    <div class="form-group{{ $errors->has('academic_year_id') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="academic_year_id">Academic Year<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <select id="academic_year_id" class="form-control" data-role="select" required="required" selected="selected" name="academic_year_id" disabled> 
                                                @foreach($academicYears as $academicYear)
                                                <option value="{{$academicYear->academic_year_id}}" {{($academicYear->year == $student->academicyear->year) ? 'selected' : ''}}>
                                                        {{$academicYear->year}}
                                                    </option>                                                
                                                @endforeach                                                
                                            </select>

                                            @if ($errors->has('academic_year_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('academic_year_id') }}</strong>
                                            </span>
                                            @endif  
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <!--student_index_number-->
                                    <div class="form-group{{ $errors->has('student_index_number') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="student_index_number">Index No:<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="student_index_number" required="required" class="form-control k-textbox" data-role="text" placeholder="Index Number" name="student_index_number" type="text" value="{{ $student->student_index_number }}" readonly>
                                            <span class="help-block">Ex:c14015</span>

                                            @if ($errors->has('student_index_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('student_index_number') }}</strong>
                                            </span>
                                            @endif  
                                        </div>
                                    </div>

                                    <!--course_id-->
                                    <div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="course_id">Course<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <select id="course_id" class="form-control" data-role="select" selected="selected" required="required" name="course_id" disabled>
                                                @foreach($courses as $course)
                                                <option value="{{$course->course_id}}" {{($course->name == $student->course->name) ? 'selected' : ''}}>
                                                        {{$course->name}}
                                                    </option>                                                
                                                @endforeach 
                                            </select>

                                            @if ($errors->has('course_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('course_id') }}</strong>
                                            </span>
                                            @endif  
                                        </div>
                                    </div>

                                    <!--specialized_area_id-->
                                    <div class="form-group{{ $errors->has('specialized_area_id') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="specialized_area_id">Specialized Area</label>
                                        <div class="controls col-sm-9">
                                            <select id="specialized_area_id" class="form-control" data-role="select" selected="selected" name="specialized_area_id" disabled>
                                               
                                                @foreach($specializedAreas as $specializedArea)
                                                <option value="{{$specializedArea->specialized_area_id}}" {{($specializedArea->name == $student->specializedarea->name) ? 'selected' : ''}}>
                                                        {{$specializedArea->name}}
                                                    </option>                                                
                                                @endforeach 
                                            </select>

                                            @if ($errors->has('specialized_area_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('specialized_area_id') }}</strong>
                                            </span>
                                            @endif 
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
                                    <div class="form-group{{ $errors->has('initials') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="initials">Initials<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="initials" required="required" class="form-control k-textbox" data-role="text" placeholder="Initials" name="initials" type="text" value="{{ $student->initials }}" readonly>

                                            @if ($errors->has('initials'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('initials') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>

                                    <!--last_name-->
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="last_name">Last Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="last_name" class="form-control k-textbox" data-role="text" placeholder="Last Name" name="last_name" type="text" value="{{ $student->last_name }}" readonly>

                                            @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="first_name">First Name<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="first_name" class="form-control k-textbox" data-role="text" required="required" placeholder="First Name" name="first_name" type="text" value="{{ $student->first_name }}" readonly>

                                            @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                        
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <!--contact_no_mobile-->
                                    <div class="form-group{{ $errors->has('contact_no_mobile') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="contact_no_mobile">Mobile</label>
                                        <div class="controls col-sm-9">
                                            <input id="contact_no_mobile" maxlength="10" class="form-control k-textbox" data-role="text" placeholder="Mobile Number" name="contact_no_mobile"  type="text" value="{{ $student->contact_no_mobile }}">

                                            @if ($errors->has('contact_no_mobile'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_no_mobile') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                       
                                    </div>

                                    <!--contact_no_home-->
                                    <div class="form-group{{ $errors->has('contact_no_home') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="contact_no_home">Home</label>
                                        <div class="controls col-sm-9">
                                            <input id="contact_no_home" maxlength="10" class="form-control k-textbox" data-role="text" placeholder="Home Contact Number" name="contact_no_home"  type="text" value="{{ $student->contact_no_home }}">

                                            @if ($errors->has('contact_no_home'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_no_home') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                       
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <!--email-->
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="email">Email Address</label>
                                        <div class="controls col-sm-9">
                                            <input id="email" class="form-control k-textbox" data-role="text" placeholder="Email Address" name="email" type="text" value="{{ $student->email }}">

                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                       
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <!--nic_number-->
                                    <div class="form-group{{ $errors->has('nic_number') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="nic_number">NIC<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="nic_number" class="form-control k-textbox" data-role="text" required="required" placeholder="National Identity Card Number" data-parsley-minwords="10" name="nic_number" type="text" value="{{ $student->nic_number }}" readonly>

                                            @if ($errors->has('nic_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nic_number') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                       
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <!--date_of_birth-->
                                    <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="date_of_birth">Date of Birth<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="date_of_birth" class="form-control k-textbox" data-role="text" required="required" placeholder="Date of Birth"  name="date_of_birth" type="date" value="{{ $student->date_of_birth }}" readonly>

                                            @if ($errors->has('date_of_birth'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date_of_birth') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                        
                                    </div>
                                </div>

                            </div>

                            <div class="row" style="display: block;">
                                <div class="col-md-6">

                                    <!--gender-->
                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3">Gender<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <label class="radio" for="male">
                                            <input value="Male" id="male" name="gender" required="required" {{($student->gender == 'Male') ? 'checked': '' }} type="radio" >
                                                Male
                                            </label>
                                            <label class="radio" for="female">
                                                <input value="Female" id="female" name="gender" required="required" {{($student->gender == 'Female') ? 'checked': '' }} type="radio">
                                                Female
                                            </label>
                                        </div>
                                        @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif 
                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <!--marriage_state-->
                                    <div class="form-group{{ $errors->has('marriage_state') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3">Marriage State<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <label class="radio" for="married">
                                                <input value="Married" id="married" name="marriage_state"  required="required" type="radio" {{($student->marriage_state == 'Married') ? 'checked' : '' }}>
                                                Married
                                            </label>

                                            <label class="radio" for="unmarried">
                                                <input value="Unmarried" id="unmarried" name="marriage_state" required="required" type="radio" {{($student->marriage_state == 'Unmarried') ? 'checked' : '' }}>
                                                Un-married
                                            </label>
                                        </div>
                                        @if ($errors->has('marriage_state'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mirrage_state') }}</strong>
                                        </span>
                                        @endif 
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
                                    <div class="form-group{{ $errors->has('home_address_1') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="home_address_1">Home Address </label>
                                        <div class="controls col-sm-9">
                                            <input id="home_address_1" class="form-control k-textbox" data-role="text" placeholder="Number" name="home_address_1"  type="text" value="{{ $student->home_address_1 }}">

                                            @if ($errors->has('home_address_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('home_address_1') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                        
                                    </div>

                                    <!--home_address_2-->
                                    <div class="form-group{{ $errors->has('home_address_2') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="home_address_2"></label>
                                        <div class="controls col-sm-9">
                                            <input id="home_address_2" class="form-control k-textbox" data-role="text" name="home_address_2" placeholder="Street" type="text" value="{{ $student->home_address_2 }}">

                                            @if ($errors->has('home_address_2'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('home_address_2') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                       
                                    </div>
                                    
                                    {{-- home_address_3 --}}
                                    <div class="form-group{{ $errors->has('home_address_3') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="home_address_3"></label>
                                        <div class="controls col-sm-9">
                                            <input id="home_address_3" class="form-control k-textbox" data-role="text" name="home_address_3" placeholder="City" type="text" value="{{ $student->home_address_3 }}">

                                            @if ($errors->has('home_address_3'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('home_address_3') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>

                                    {{-- current_address_1 --}}
                                    <div class="form-group{{ $errors->has('current_address_1') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="current_address_1">Current Address</label>
                                        <div class="controls col-sm-9">
                                            <input id="current_address_1" class="form-control k-textbox" data-role="text" placeholder="Number" name="current_address_1" type="text" value="{{ $student->current_address_1 }}">

                                            @if ($errors->has('current_address_1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('current_address_1') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                      
                                    </div>

                                    {{-- current_address_2 --}}
                                    <div class="form-group{{ $errors->has('current_address_2') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="current_address_2"></label>
                                        <div class="controls col-sm-9">
                                            <input id="current_address_2" class="form-control k-textbox" data-role="text" placeholder="Street" name="current_address_2"  type="text" value="{{ $student->current_address_2 }}">

                                            @if ($errors->has('current_address_2'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('current_address_2') }}</strong>
                                            </span>
                                            @endif 
                                        </div>                                        
                                    </div>
                                    
                                    {{-- current_address_3 --}}
                                    <div class="form-group{{ $errors->has('current_address_3') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3 sr-only" for="current_address_3"></label>
                                        <div class="controls col-sm-9">
                                            <input id="current_address_3" class="form-control k-textbox" data-role="text" placeholder="City" name="current_address_3" type="text" value="{{ $student->current_address_3 }}">

                                            @if ($errors->has('current_address_3'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('current_address_3') }}</strong>
                                            </span>
                                            @endif 
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

                                    <div class="form-group{{ $errors->has('fb_url') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="fb_url">Facebook</label>
                                        <div class="controls col-sm-9">
                                            <input id="fb_url" class="form-control k-textbox" data-role="text" placeholder="Facebook Profile URL" name="fb_url" type="text" value="{{ $student->fb_url }}">
                                            @if ($errors->has('fb_url'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fb_url') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('linkedin_url') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="linkedin_url">Linkedin</label>
                                        <div class="controls col-sm-9">
                                            <input id="linkedin_url" class="form-control k-textbox" data-role="text" placeholder="Linkedin Profile URL" name="linkedin_url" type="text" value="{{ $student->linkedin_url }}">

                                            @if ($errors->has('linkedin_url'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('linkedin_url') }}</strong>
                                            </span>
                                            @endif 
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
                                    <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="father_name">Father's Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="father_name" class="form-control k-textbox" data-role="text" placeholder="Father's Name" name="father_name"  type="text" value="{{ $student->father_name }}">

                                            @if ($errors->has('father_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('father_name') }}</strong>
                                            </span>
                                            @endif 
                                        </div>

                                    </div>

                                    <!--father_occupation-->
                                    <div class="form-group{{ $errors->has('father_occupation') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="father_occupation">Father's Occupation</label>
                                        <div class="controls col-sm-9">
                                            <input id="father_occupation" class="form-control k-textbox" data-role="text" placeholder="Father's Occupation" name="father_occupation"  type="text" value="{{ $student->father_occupation }}">

                                            @if ($errors->has('father_occupation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('father_occupation') }}</strong>
                                            </span>
                                            @endif 
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <!--mother_name-->
                                    <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="mother_name">Mother's Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="mother_name" class="form-control k-textbox" data-role="text" placeholder="Mother's Name" name="mother_name" type="text" value="{{ $student->mother_name }}">

                                            @if ($errors->has('mother_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mother_name') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>

                                    <!--mother_occupation-->
                                    <div class="form-group{{ $errors->has('mother_occupation') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="mother_occupation">Mother's Occupation</label>
                                        <div class="controls col-sm-9">
                                            <input id="mother_occupation" class="form-control k-textbox" data-role="text" placeholder="Mother's Occupation" name="mother_occupation"  type="text" value="{{ $student->mother_occupation }}">

                                            @if ($errors->has('mother_occupation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mother_occupation') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <!--number_of_sisters_and_brothers-->
                                    <div class="form-group{{ $errors->has('number_of_sisters_and_brothers') ? ' has-error' : '' }}" style="display: block;">
                                        <label class="control-label control-label-left col-sm-3" for="number_of_sisters_and_brothers">Number of Brothers &amp; Sisters</label>
                                        <div class="controls col-sm-9">
                                            <input id="number_of_sisters_and_brothers" class="form-control k-textbox" data-role="text" placeholder="Number of Brothers &amp; Sisters" name="number_of_sisters_and_brothers"  type="text" value="{{ $student->number_of_sisters_and_brothers }}">

                                            @if ($errors->has('number_of_sisters_and_brothers'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('number_of_sisters_and_brothers') }}</strong>
                                            </span>
                                            @endif 
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
                                    <div class="form-group{{ $errors->has('dissertation_title') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="dissertation_title">Title</label>
                                        <div class="controls col-sm-9">
                                            <input id="dissertation_title" class="form-control k-textbox" data-role="text" placeholder="Dissertation Title" name="dissertation_title" type="text" value="{{ $student->dissertation_title }}">

                                            @if ($errors->has('dissertation_title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dissertation_title') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>

                                    <!--supervisor_name-->
                                    <div class="form-group{{ $errors->has('supervisor_name') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="supervisor_name">Supervisor</label>
                                        <div class="controls col-sm-9">
                                            <input id="supervisor_name" class="form-control k-textbox" data-role="text" placeholder="Supervisor Name" name="supervisor_name" type="text" value="{{ $student->supervisor_name }}">

                                            @if ($errors->has('supervisor_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('supervisor_name') }}</strong>
                                            </span>
                                            @endif 
                                        </div>
                                    </div>

                                    <!--dissertation_published_link-->
                                    <div class="form-group{{ $errors->has('dissertation_published_link') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="dissertation_published_link">Link</label>
                                        <div class="controls col-sm-9">
                                            <input id="dissertation_published_link" class="form-control k-textbox" data-role="text" name="dissertation_published_link" placeholder="Published Link" type="text" value="{{ $student->dissertation_published_link }}">

                                            @if ($errors->has('dissertation_published_link'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dissertation_published_link') }}</strong>
                                            </span>
                                            @endif 
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
                                            <img class="img-fluid img-thumbnail p-3" id="uploadPreview" src="{{$student->profile_picture }}" alt="Profile Picture"> 
                                        
                                            <input type="hidden" id="_img_path" name="_img_path" value="{{$student->profile_picture}}">
                                        </div>
                                    </div>                                    

                                    <!--profile_picture upload button-->
                                    <div class="custom-file">
                                        <input type="file" accept=".png,.jpg,.jpeg,.gif" class="custom-file-input" id="profile_picture" name="profile_picture" onchange="PreviewImage();">
                                        <label class="custom-file-label" for="profile_picture">Choose profile picture</label>

                                        <script type="text/javascript">

                                            function PreviewImage() {
                                                var oFReader = new FileReader();
                                                oFReader.readAsDataURL(document.getElementById("profile_picture").files[0]);
                                        
                                                oFReader.onload = function (oFREvent) {
                                                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                                                };
                                            };
                                        
                                        </script>
                                    </div>
                                    
                                </div>

                                <!--bio-->
                                <div class="col-md-5">
                                    <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="bio">Bio</label>
                                        <div class="controls col-sm-9">
                                        <textarea id="bio" rows="8" class="form-control k-textbox"   placeholder="Tell about yourself" name="bio" type="text" >{{$student->bio}}</textarea>

                                            @if ($errors->has('bio'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bio') }}</strong>
                                            </span>
                                            @endif                            
                                        </div>                                       
                                    </div>

                                    <div> 
                                        <br> 
                                        <button type="submit" style="margin:5px" class="btn btn-success pull-right">Update</button>
                                        <button type="reset" style="margin:5px" class="btn btn-default pull-right">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of profile picture-->

                </div>
            </div>
        
        {{-- {{Form::hidden('_method', 'PUT')}} --}}
        {!! Form::close() !!}

    </div>
</div>


@endsection         
