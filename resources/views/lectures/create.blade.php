@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Add New Lecturer <a href="/lectures" class="btn btn-default pull-right">Back</a>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li>
                        <i class="glyphicon glyphicon-user"></i>  <a href="/lectures">Lecturers</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-file"></i> Add New
                    </li>
                </ol>
        </div>
</div>

    <div class="row">
        
        {!! Form::open(['action' =>'LecturesController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}

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
                                        <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">                                                
                                            <label class="control-label control-label-left col-sm-3" for="employee_id">Employee ID<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="employee_id" class="form-control k-textbox" data-role="text" placeholder="Employee ID" name="employee_id" required="required"  type="text" value="{{ old('employee_id') }}">

                                                @if ($errors->has('employee_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_id') }}</strong>
                                                </span>
                                                @endif                                             
                                            </div>
                                        </div>

                                        <!--initials-->
                                        <div class="form-group{{ $errors->has('initials') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="initials">Initials<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="initials" class="form-control k-textbox" data-role="text" placeholder="Initials" name="initials" required="required"  type="text" value="{{ old('initials') }}">

                                                @if ($errors->has('initials'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('initials') }}</strong>
                                                </span>
                                                @endif 
                                            </div>
                                        </div>

                                        <!--first_name-->
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="first_name">First Name<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="first_name" class="form-control k-textbox" data-role="text" placeholder="First Name" name="first_name" required="required" type="text" value="{{ old('first_name') }}">

                                                @if ($errors->has('first_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                                @endif 
                                            </div>
                                        </div>

                                        <!--last_name-->
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="last_name">Last Name</label>
                                            <div class="controls col-sm-9">
                                                <input id="last_name" class="form-control k-textbox" data-role="text" placeholder="Last Name" name="last_name" type="text" value="{{ old('last_name') }}">

                                                @if ($errors->has('last_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                                @endif 
                                            </div>
                                        </div>

                                        <!--email-->
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="email">Email<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                    <input id="email" class="form-control k-textbox" data-role="text" placeholder="Email Address" name="email" type="text" value="{{ old('email') }}">

                                                    @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif 
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="col-md-6">

                                        <!--department_id-->
                                        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="department_id">Department <span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <select id="department_id" class="form-control" data-role="select"  required="required" name="department_id">
                                                    @foreach($departments as $department)
                                                    <option value="{{$department->department_id}}" {{ (Illuminate\Support\Facades\Input::old("department_id") == $department->department_id ? "selected": "") }}>
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

                                        <!--mobile-->
                                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="mobile">Mobile</label>
                                            <div class="controls col-sm-9">
                                                <input id="mobile" class="form-control k-textbox" data-role="text" placeholder="Mobile Number" name="mobile" type="text" value="{{ old('mobile') }}">

                                                @if ($errors->has('mobile'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                </span>
                                                @endif 
                                            </div>
                                        </div>

                                        <!--gender-->
                                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}" style="display: block;">
                                            <label class="control-label control-label-left col-sm-3">Gender<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <label class="radio" for="male">
                                                    <input value="Male" id="male" name="gender" required="required" checked="checked" type="radio" {{ (Illuminate\Support\Facades\Input::old("gender") == 'Male' ? "checked": "") }}>
                                                    Male
                                                </label>
                                                <label class="radio" for="female">
                                                    <input value="Female" id="female" name="gender" required="required" type="radio" {{ (Illuminate\Support\Facades\Input::old("gender") == 'Female' ? "checked": "") }}>
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
                                </div>
                            </div>
                        </div>

                        <div id="panel2" class="panel panel-default" data-role="panel">
                            <div class="panel-heading">Quelification Details</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <!--qualifications-->
                                        <div class="form-group{{ $errors->has('qualifications') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="qualifications">Qualifications</label>
                                            <div class="controls col-sm-9">
                                                <textarea id="qualifications" placeholder="Tell about your qualifications" rows="3" class="form-control k-textbox" data-role="textarea" name="qualifications" style="height: 182px;">{{ old('qualifications') }}</textarea>

                                                @if ($errors->has('qualifications'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('qualifications') }}</strong>
                                                </span>
                                                @endif 
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
                                                <img class="img-fluid img-thumbnail p-3" id="uploadPreview" src="{{ url('/storage/avatars/no_image.png')}}" alt="Profile Picture"> 
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
                                                }
                                                ;

                                            </script>
                                        </div>

                                    </div>

                                    <!--bio-->
                                    <div class="col-md-5">
                                        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="bio">Bio</label>
                                            <div class="controls col-sm-9">
                                                <textarea id="bio" rows="8" class="form-control k-textbox"   placeholder="Tell about yourself" name="bio" type="text">{{ old('bio') }}</textarea>

                                                @if ($errors->has('bio'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bio') }}</strong>
                                                </span>
                                                @endif                            
                                            </div>                                       
                                        </div>

                                        <div> 
                                            <br> 
                                            <button type="submit"  class="btn btn-success pull-right" style="margin:5px">Save</button>
                                            <button type="reset" class="btn btn-default pull-right" style="margin:5px">Reset</button>
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