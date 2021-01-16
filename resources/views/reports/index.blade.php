@extends('layouts.dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Reports
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-stats"></i> Reports
                    </li>                     
                </ol>
        </div>



        <div class="col-lg-12">              

                <div class="panel-group" id="accordion">

                        {{--Students Details --}}
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                             Student Details</a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                              
                              {{-- Students in specific academic year --}}
                              <div class="jumbotron">
                                {!! Form::open(['action' =>'ReportsController@studentsInSpecificAcademicYear' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}
                                  <p>Students in specific academic year :
                                    <button type="submit" id="pdf_0" class="btn btn-primary pull-right">PDF</button>
                                    <button type="submit" id="excel_0" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>

                                    <button type="button" id="show_0" class="btn btn-default pull-right" style="margin-right:5px">Select Columns</button>

                                  </p>
                                  <hr>

                                  <div class="form-group">
                                      <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Academic Year<span class="req"> *</span></label>
                                      <div class="controls col-sm-9">
                                          <select id="academic_year_id" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" selected="selected" name="academic_year_id">
                                              @foreach($academicYears as $academicYear)
                                                  <option value="{{$academicYear->academic_year_id}}">
                                                      {{$academicYear->year}}
                                                  </option>                                                
                                              @endforeach                                                
                                          </select>
                                      </div>
                                  </div>

                                  <div id="well_0" class="well" style="display:none">
                                    <div class="row">
                                        <div class="col-lg-3">  
                                            <div class="row" style="margin-left:10px">
                                                <input type="checkbox" id="student_registration_number" name="columns[]" value="student_registration_number" checked> Registration Number <br>
                                                <input type="checkbox" id="student_index_number" name="columns[]" value="student_index_number" checked> Index Number <br>
                                                <input type="checkbox" id="department_id" name="columns[]" value="department_id" checked> Department <br>
                                                <input type="checkbox" id="course_id" name="columns[]" value="course_id" checked> Course <br>
                                                <input type="checkbox" id="academic_year_id" name="columns[]" value="academic_year_id" checked> Academic Year <br>
                                                <input type="checkbox" id="specialized_area_id" name="columns[]" value="specialized_area_id" checked> Specialized Area<br>
                                                <input type="checkbox" id="initials" name="columns[]" value="initials" checked> Initials <br>
                                                <input type="checkbox" id="first_name" name="columns[]" value="first_name" checked> First Name <br>
                                                <input type="checkbox" id="last_name" name="columns[]" value="last_name" checked> Last Name <br>
                                                <input type="checkbox" id="nic_number" name="columns[]" value="nic_number" checked> NIC Number <br>
                                            </div>
                                        </div>   
                                        <div class="col-lg-3">  
                                            <div class="row">
                                                <input type="checkbox" id="date_of_birth" name="columns[]" value="date_of_birth"> Date of Birth <br>
                                                <input type="checkbox" id="gender" name="columns[]" value="gender"> Gender <br>
                                                <input type="checkbox" id="marriage_state" name="columns[]" value="marriage_state"> Marriage State <br>
                                                <input type="checkbox" id="email" name="columns[]" value="email"> Email <br>
                                                <input type="checkbox" id="contact_no_mobile" name="columns[]" value="contact_no_mobile"> Contact No Mobile <br>
                                                <input type="checkbox" id="contact_no_home" name="columns[]" value="contact_no_home"> Contact No Home <br>
                                                <input type="checkbox" id="home_address_1" name="columns[]" value="home_address_1"> Home Address 1 <br>
                                                <input type="checkbox" id="home_address_2" name="columns[]" value="home_address_2"> Home Address 2 <br>
                                                <input type="checkbox" id="home_address_3" name="columns[]" value="home_address_3"> Home Address 3 <br>
                                                <input type="checkbox" id="current_address_1" name="columns[]" value="current_address_1"> Current Address 1 <br>                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-3">  
                                                <div class="row">
                                                <input type="checkbox" id="current_address_2" name="columns[]" value="current_address_2"> Current Address 2 <br>
                                                <input type="checkbox" id="current_address_3" name="columns[]" value="current_address_3"> Current Address 3 <br>
                                                <input type="checkbox" id="fb_url" name="columns[]" value="fb_url"> FB Profile<br>
                                                <input type="checkbox" id="linkedin_url" name="columns[]" value="linkedin_url"> Linkedin Profile <br>
                                                <input type="checkbox" id="father_name" name="columns[]" value="father_name"> Father Name<br>
                                                <input type="checkbox" id="father_occupation" name="columns[]" value="father_occupation"> Father Occupation <br>
                                                <input type="checkbox" id="mother_name" name="columns[]" value="mother_name"> Mother Name <br>
                                                <input type="checkbox" id="mother_occupation" name="columns[]" value="mother_occupation"> Mother Occupation <br>
                                                <input type="checkbox" id="number_of_sisters_and_brothers" name="columns[]" value="number_of_sisters_and_brothers"> Number of Sister and Brothers <br>
                                                <input type="checkbox" id="dissertation_title" name="columns[]" value="dissertation_title"> Dissertation Title <br>                                                
                                                </div>
                                            </div>   
                                            <div class="col-lg-3">  
                                                <div class="row">
                                                <input type="checkbox" id="dissertation_published_link" name="columns[]" value="dissertation_published_link"> Dissertation Published Link<br>
                                                <input type="checkbox" id="supervisor_name" name="columns[]" value="supervisor_name"> Supervisor Name<br>
                                                <input type="checkbox" id="profile_picture" name="columns[]" value="profile_picture"> Profile Picture <br>
                                                <input type="checkbox" id="bio" name="columns[]" value="bio"> Bio <br>                                                             
                                                </div>
                                            </div>                     
                                    </div>                    
                                </div> {{-- End well --}}

                                  <input type="hidden" id="export_type_0" name="export_type" value="">

                                  <script>
                                      //export_type set as true
                                      $("#pdf_0").click(function(){
                                          $("#export_type_0").attr("value","pdf");
                                      });
                                      
                                      //export_type set as false
                                      $("#excel_0").click(function(){
                                          $("#export_type_0").attr("value","excel");
                                      });                       
                                  </Script>

                                  {!!Form::close()!!}
                              </div>   

                              {{-- Students in specific course --}}
                              <div class="jumbotron">
                                  {!! Form::open(['action' =>'ReportsController@studentsInSpecificCourse' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  

                                  <p>Students in specific course :
                                    <button id="pdf_1" class="btn btn-primary pull-right">PDF</button>
                                    <button id="excel_1" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>

                                    <button type="button" id="show_1" class="btn btn-default pull-right" style="margin-right:5px">Select Columns</button>

                                  </p>
                                  <hr>

                                  <div class="form-group">
                                      <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Academic Year<span class="req"> *</span></label>
                                      <div class="controls col-sm-9">
                                          <select id="academic_year_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-role="select" required="required" selected="selected" name="academic_year_id">
                                              @foreach($academicYears as $academicYear)
                                                  <option value="{{$academicYear->academic_year_id}}">
                                                      {{$academicYear->year}}
                                                  </option>                                                
                                              @endforeach                                                
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label control-label-left col-sm-3" for="course_id">Course<span class="req"> *</span></label>
                                      <div class="controls col-sm-9">
                                          <select id="course_id" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" selected="selected" required="required" name="course_id">
                                              @foreach($courses as $course)
                                                  <option value="{{$course->course_id}}">
                                                      {{$course->name}}
                                                  </option>                                                
                                              @endforeach 
                                          </select>                                        
                                      </div>
                                  </div>

                                  <div id="well_1" class="well" style="display:none">
                                        <div class="row">
                                            <div class="col-lg-3">  
                                                <div class="row" style="margin-left:10px">
                                                    <input type="checkbox" id="student_registration_number" name="columns[]" value="student_registration_number" checked> Registration Number <br>
                                                    <input type="checkbox" id="student_index_number" name="columns[]" value="student_index_number" checked> Index Number <br>
                                                    <input type="checkbox" id="department_id" name="columns[]" value="department_id" checked> Department <br>
                                                    <input type="checkbox" id="course_id" name="columns[]" value="course_id" checked> Course <br>
                                                    <input type="checkbox" id="academic_year_id" name="columns[]" value="academic_year_id" checked> Academic Year <br>
                                                    <input type="checkbox" id="specialized_area_id" name="columns[]" value="specialized_area_id" checked> Specialized Area<br>
                                                    <input type="checkbox" id="initials" name="columns[]" value="initials" checked> Initials <br>
                                                    <input type="checkbox" id="first_name" name="columns[]" value="first_name" checked> First Name <br>
                                                    <input type="checkbox" id="last_name" name="columns[]" value="last_name" checked> Last Name <br>
                                                    <input type="checkbox" id="nic_number" name="columns[]" value="nic_number" checked> NIC Number <br>
                                                </div>
                                            </div>   
                                            <div class="col-lg-3">  
                                                <div class="row">
                                                    <input type="checkbox" id="date_of_birth" name="columns[]" value="date_of_birth"> Date of Birth <br>
                                                    <input type="checkbox" id="gender" name="columns[]" value="gender"> Gender <br>
                                                    <input type="checkbox" id="marriage_state" name="columns[]" value="marriage_state"> Marriage State <br>
                                                    <input type="checkbox" id="email" name="columns[]" value="email"> Email <br>
                                                    <input type="checkbox" id="contact_no_mobile" name="columns[]" value="contact_no_mobile"> Contact No Mobile <br>
                                                    <input type="checkbox" id="contact_no_home" name="columns[]" value="contact_no_home"> Contact No Home <br>
                                                    <input type="checkbox" id="home_address_1" name="columns[]" value="home_address_1"> Home Address 1 <br>
                                                    <input type="checkbox" id="home_address_2" name="columns[]" value="home_address_2"> Home Address 2 <br>
                                                    <input type="checkbox" id="home_address_3" name="columns[]" value="home_address_3"> Home Address 3 <br>
                                                    <input type="checkbox" id="current_address_1" name="columns[]" value="current_address_1"> Current Address 1 <br>                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="current_address_2" name="columns[]" value="current_address_2"> Current Address 2 <br>
                                                    <input type="checkbox" id="current_address_3" name="columns[]" value="current_address_3"> Current Address 3 <br>
                                                    <input type="checkbox" id="fb_url" name="columns[]" value="fb_url"> FB Profile<br>
                                                    <input type="checkbox" id="linkedin_url" name="columns[]" value="linkedin_url"> Linkedin Profile <br>
                                                    <input type="checkbox" id="father_name" name="columns[]" value="father_name"> Father Name<br>
                                                    <input type="checkbox" id="father_occupation" name="columns[]" value="father_occupation"> Father Occupation <br>
                                                    <input type="checkbox" id="mother_name" name="columns[]" value="mother_name"> Mother Name <br>
                                                    <input type="checkbox" id="mother_occupation" name="columns[]" value="mother_occupation"> Mother Occupation <br>
                                                    <input type="checkbox" id="number_of_sisters_and_brothers" name="columns[]" value="number_of_sisters_and_brothers"> Number of Sister and Brothers <br>
                                                    <input type="checkbox" id="dissertation_title" name="columns[]" value="dissertation_title"> Dissertation Title <br>                                                
                                                    </div>
                                                </div>   
                                                <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="dissertation_published_link" name="columns[]" value="dissertation_published_link"> Dissertation Published Link<br>
                                                    <input type="checkbox" id="supervisor_name" name="columns[]" value="supervisor_name"> Supervisor Name<br>
                                                    <input type="checkbox" id="profile_picture" name="columns[]" value="profile_picture"> Profile Picture <br>
                                                    <input type="checkbox" id="bio" name="columns[]" value="bio"> Bio <br>                                                             
                                                    </div>
                                                </div>                     
                                        </div>                    
                                    </div> {{-- End well --}}

                                  <input type="hidden" id="export_type_1" name="export_type" value="">

                                  <script>
                                      //export_type set as true
                                      $("#pdf_1").click(function(){
                                          $("#export_type_1").attr("value","pdf");
                                      });
                                      
                                      //export_type set as false
                                      $("#excel_1").click(function(){
                                          $("#export_type_1").attr("value","excel");
                                      });                       
                                  </Script>

                                  {!!Form::close()!!}
                              </div>   
                                     
                                
                            {{-- Students in specific department --}}
                            <div class="jumbotron">
                                {!! Form::open(['action' =>'ReportsController@studentsInSpecificDepartment' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  

                                <p>Students in specific department :
                                    <button id="pdf_2" class="btn btn-primary pull-right">PDF</button>
                                    <button id="excel_2" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>

                                    <button type="button" id="show_2" class="btn btn-default pull-right" style="margin-right:5px">Select Columns</button>

                                </p>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Academic Year<span class="req"> *</span></label>
                                    <div class="controls col-sm-9">
                                        <select id="academic_year_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-role="select" required="required" selected="selected" name="academic_year_id">
                                            @foreach($academicYears as $academicYear)
                                                <option value="{{$academicYear->academic_year_id}}">
                                                    {{$academicYear->year}}
                                                </option>                                                
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="department_id">Select Department<span class="req"> *</span></label>
                                    <div class="controls col-sm-9">
                                        <select id="department_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-role="select" selected="selected" required="required" name="department_id">
                                            @foreach($departments as $department)
                                                <option value="{{$department->department_id}}">
                                                    {{$department->name}}
                                                </option>                                                
                                            @endforeach 
                                        </select>                                        
                                    </div>
                                </div>

                                <div id="well_2" class="well" style="display:none">
                                        <div class="row">
                                            <div class="col-lg-3">  
                                                <div class="row" style="margin-left:10px">
                                                    <input type="checkbox" id="student_registration_number" name="columns[]" value="student_registration_number" checked> Registration Number <br>
                                                    <input type="checkbox" id="student_index_number" name="columns[]" value="student_index_number" checked> Index Number <br>
                                                    <input type="checkbox" id="department_id" name="columns[]" value="department_id" checked> Department <br>
                                                    <input type="checkbox" id="course_id" name="columns[]" value="course_id" checked> Course <br>
                                                    <input type="checkbox" id="academic_year_id" name="columns[]" value="academic_year_id" checked> Academic Year <br>
                                                    <input type="checkbox" id="specialized_area_id" name="columns[]" value="specialized_area_id" checked> Specialized Area<br>
                                                    <input type="checkbox" id="initials" name="columns[]" value="initials" checked> Initials <br>
                                                    <input type="checkbox" id="first_name" name="columns[]" value="first_name" checked> First Name <br>
                                                    <input type="checkbox" id="last_name" name="columns[]" value="last_name" checked> Last Name <br>
                                                    <input type="checkbox" id="nic_number" name="columns[]" value="nic_number" checked> NIC Number <br>
                                                </div>
                                            </div>   
                                            <div class="col-lg-3">  
                                                <div class="row">
                                                    <input type="checkbox" id="date_of_birth" name="columns[]" value="date_of_birth"> Date of Birth <br>
                                                    <input type="checkbox" id="gender" name="columns[]" value="gender"> Gender <br>
                                                    <input type="checkbox" id="marriage_state" name="columns[]" value="marriage_state"> Marriage State <br>
                                                    <input type="checkbox" id="email" name="columns[]" value="email"> Email <br>
                                                    <input type="checkbox" id="contact_no_mobile" name="columns[]" value="contact_no_mobile"> Contact No Mobile <br>
                                                    <input type="checkbox" id="contact_no_home" name="columns[]" value="contact_no_home"> Contact No Home <br>
                                                    <input type="checkbox" id="home_address_1" name="columns[]" value="home_address_1"> Home Address 1 <br>
                                                    <input type="checkbox" id="home_address_2" name="columns[]" value="home_address_2"> Home Address 2 <br>
                                                    <input type="checkbox" id="home_address_3" name="columns[]" value="home_address_3"> Home Address 3 <br>
                                                    <input type="checkbox" id="current_address_1" name="columns[]" value="current_address_1"> Current Address 1 <br>                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="current_address_2" name="columns[]" value="current_address_2"> Current Address 2 <br>
                                                    <input type="checkbox" id="current_address_3" name="columns[]" value="current_address_3"> Current Address 3 <br>
                                                    <input type="checkbox" id="fb_url" name="columns[]" value="fb_url"> FB Profile<br>
                                                    <input type="checkbox" id="linkedin_url" name="columns[]" value="linkedin_url"> Linkedin Profile <br>
                                                    <input type="checkbox" id="father_name" name="columns[]" value="father_name"> Father Name<br>
                                                    <input type="checkbox" id="father_occupation" name="columns[]" value="father_occupation"> Father Occupation <br>
                                                    <input type="checkbox" id="mother_name" name="columns[]" value="mother_name"> Mother Name <br>
                                                    <input type="checkbox" id="mother_occupation" name="columns[]" value="mother_occupation"> Mother Occupation <br>
                                                    <input type="checkbox" id="number_of_sisters_and_brothers" name="columns[]" value="number_of_sisters_and_brothers"> Number of Sister and Brothers <br>
                                                    <input type="checkbox" id="dissertation_title" name="columns[]" value="dissertation_title"> Dissertation Title <br>                                                
                                                    </div>
                                                </div>   
                                                <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="dissertation_published_link" name="columns[]" value="dissertation_published_link"> Dissertation Published Link<br>
                                                    <input type="checkbox" id="supervisor_name" name="columns[]" value="supervisor_name"> Supervisor Name<br>
                                                    <input type="checkbox" id="profile_picture" name="columns[]" value="profile_picture"> Profile Picture <br>
                                                    <input type="checkbox" id="bio" name="columns[]" value="bio"> Bio <br>                                                             
                                                    </div>
                                                </div>                     
                                        </div>                    
                                    </div> {{-- End well --}}

                                <input type="hidden" id="export_type_2" name="export_type" value="">

                                <script>
                                    //export_type set as true
                                    $("#pdf_2").click(function(){
                                        $("#export_type_2").attr("value","pdf");
                                    });
                                    
                                    //export_type set as false
                                    $("#excel_2").click(function(){
                                        $("#export_type_2").attr("value","excel");
                                    });                       
                                </Script>

                                {!!Form::close()!!}
                        </div> 

                        {{-- Students in specific specialized area --}}
                        <div class="jumbotron">
                                {!! Form::open(['action' =>'ReportsController@studentsInSpecificSpecializedArea' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  

                                <p>Students in specific specialized area :
                                    <button id="pdf_3" class="btn btn-primary pull-right">PDF</button>
                                    <button id="excel_3" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>

                                    <button type="button" id="show_3" class="btn btn-default pull-right" style="margin-right:5px">Select Columns</button>

                                </p>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Academic Year<span class="req"> *</span></label>
                                    <div class="controls col-sm-9">
                                        <select id="academic_year_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-role="select" required="required" selected="selected" name="academic_year_id">
                                            @foreach($academicYears as $academicYear)
                                                <option value="{{$academicYear->academic_year_id}}">
                                                    {{$academicYear->year}}
                                                </option>                                                
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="specialized_area_id">Select Specialized Area<span class="req"> *</span></label>
                                    <div class="controls col-sm-9">
                                        <select id="specialized_area_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-role="select" selected="selected" required="required" name="specialized_area_id">
                                            @foreach($specializedAreas as $specializedArea)
                                                <option value="{{$specializedArea->specialized_area_id}}">
                                                    {{$specializedArea->name}}
                                                </option>                                                
                                            @endforeach 
                                        </select>                                        
                                    </div>
                                </div>

                                <div id="well_3" class="well" style="display:none">
                                        <div class="row">
                                            <div class="col-lg-3">  
                                                <div class="row" style="margin-left:10px">
                                                    <input type="checkbox" id="student_registration_number" name="columns[]" value="student_registration_number" checked> Registration Number <br>
                                                    <input type="checkbox" id="student_index_number" name="columns[]" value="student_index_number" checked> Index Number <br>
                                                    <input type="checkbox" id="department_id" name="columns[]" value="department_id" checked> Department <br>
                                                    <input type="checkbox" id="course_id" name="columns[]" value="course_id" checked> Course <br>
                                                    <input type="checkbox" id="academic_year_id" name="columns[]" value="academic_year_id" checked> Academic Year <br>
                                                    <input type="checkbox" id="specialized_area_id" name="columns[]" value="specialized_area_id" checked> Specialized Area<br>
                                                    <input type="checkbox" id="initials" name="columns[]" value="initials" checked> Initials <br>
                                                    <input type="checkbox" id="first_name" name="columns[]" value="first_name" checked> First Name <br>
                                                    <input type="checkbox" id="last_name" name="columns[]" value="last_name" checked> Last Name <br>
                                                    <input type="checkbox" id="nic_number" name="columns[]" value="nic_number" checked> NIC Number <br>
                                                </div>
                                            </div>   
                                            <div class="col-lg-3">  
                                                <div class="row">
                                                    <input type="checkbox" id="date_of_birth" name="columns[]" value="date_of_birth"> Date of Birth <br>
                                                    <input type="checkbox" id="gender" name="columns[]" value="gender"> Gender <br>
                                                    <input type="checkbox" id="marriage_state" name="columns[]" value="marriage_state"> Marriage State <br>
                                                    <input type="checkbox" id="email" name="columns[]" value="email"> Email <br>
                                                    <input type="checkbox" id="contact_no_mobile" name="columns[]" value="contact_no_mobile"> Contact No Mobile <br>
                                                    <input type="checkbox" id="contact_no_home" name="columns[]" value="contact_no_home"> Contact No Home <br>
                                                    <input type="checkbox" id="home_address_1" name="columns[]" value="home_address_1"> Home Address 1 <br>
                                                    <input type="checkbox" id="home_address_2" name="columns[]" value="home_address_2"> Home Address 2 <br>
                                                    <input type="checkbox" id="home_address_3" name="columns[]" value="home_address_3"> Home Address 3 <br>
                                                    <input type="checkbox" id="current_address_1" name="columns[]" value="current_address_1"> Current Address 1 <br>                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="current_address_2" name="columns[]" value="current_address_2"> Current Address 2 <br>
                                                    <input type="checkbox" id="current_address_3" name="columns[]" value="current_address_3"> Current Address 3 <br>
                                                    <input type="checkbox" id="fb_url" name="columns[]" value="fb_url"> FB Profile<br>
                                                    <input type="checkbox" id="linkedin_url" name="columns[]" value="linkedin_url"> Linkedin Profile <br>
                                                    <input type="checkbox" id="father_name" name="columns[]" value="father_name"> Father Name<br>
                                                    <input type="checkbox" id="father_occupation" name="columns[]" value="father_occupation"> Father Occupation <br>
                                                    <input type="checkbox" id="mother_name" name="columns[]" value="mother_name"> Mother Name <br>
                                                    <input type="checkbox" id="mother_occupation" name="columns[]" value="mother_occupation"> Mother Occupation <br>
                                                    <input type="checkbox" id="number_of_sisters_and_brothers" name="columns[]" value="number_of_sisters_and_brothers"> Number of Sister and Brothers <br>
                                                    <input type="checkbox" id="dissertation_title" name="columns[]" value="dissertation_title"> Dissertation Title <br>                                                
                                                    </div>
                                                </div>   
                                                <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="dissertation_published_link" name="columns[]" value="dissertation_published_link"> Dissertation Published Link<br>
                                                    <input type="checkbox" id="supervisor_name" name="columns[]" value="supervisor_name"> Supervisor Name<br>
                                                    <input type="checkbox" id="profile_picture" name="columns[]" value="profile_picture"> Profile Picture <br>
                                                    <input type="checkbox" id="bio" name="columns[]" value="bio"> Bio <br>                                                             
                                                    </div>
                                                </div>                     
                                        </div>                    
                                    </div> {{-- End well --}}

                                <input type="hidden" id="export_type_3" name="export_type" value="">

                                <script>
                                    //export_type set as true
                                    $("#pdf_3").click(function(){
                                        $("#export_type_3").attr("value","pdf");
                                    });
                                    
                                    //export_type set as false
                                    $("#excel_3").click(function(){
                                        $("#export_type_3").attr("value","excel");
                                    });                       
                                </Script>

                                {!!Form::close()!!}
                        </div>


                        {{-- Full Details of a student --}}
                        <div class="jumbotron">
                                {!! Form::open(['action' =>'ReportsController@fullDetailsOfStudent' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  

                                <p>Full details of a student :
                                    <button id="pdf_4" class="btn btn-primary pull-right">PDF</button>
                                    <button id="excel_4" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>

                                    <button type="button" id="show_4" class="btn btn-default pull-right" style="margin-right:5px">Select Columns</button>

                                </p>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Registration Number<span class="req"> *</span></label>
                                    <div class="controls col-sm-9">
                                        <input type="text" class="form-control" id="student_registration_number" name="student_registration_number" placeholder="Student registration number" required>
                                    </div>
                                </div>
                                

                                <div id="well_4" class="well" style="display:none">
                                        <div class="row">
                                            <div class="col-lg-3">  
                                                <div class="row" style="margin-left:10px">
                                                    <input type="checkbox" id="student_registration_number" name="columns[]" value="student_registration_number" checked> Registration Number <br>
                                                    <input type="checkbox" id="student_index_number" name="columns[]" value="student_index_number" checked> Index Number <br>
                                                    <input type="checkbox" id="department_id" name="columns[]" value="department_id" checked> Department <br>
                                                    <input type="checkbox" id="course_id" name="columns[]" value="course_id" checked> Course <br>
                                                    <input type="checkbox" id="academic_year_id" name="columns[]" value="academic_year_id" checked> Academic Year <br>
                                                    <input type="checkbox" id="specialized_area_id" name="columns[]" value="specialized_area_id" checked> Specialized Area<br>
                                                    <input type="checkbox" id="initials" name="columns[]" value="initials" checked> Initials <br>
                                                    <input type="checkbox" id="first_name" name="columns[]" value="first_name" checked> First Name <br>
                                                    <input type="checkbox" id="last_name" name="columns[]" value="last_name" checked> Last Name <br>
                                                    <input type="checkbox" id="nic_number" name="columns[]" value="nic_number" checked> NIC Number <br>
                                                </div>
                                            </div>   
                                            <div class="col-lg-3">  
                                                <div class="row">
                                                    <input type="checkbox" id="date_of_birth" name="columns[]" value="date_of_birth"> Date of Birth <br>
                                                    <input type="checkbox" id="gender" name="columns[]" value="gender"> Gender <br>
                                                    <input type="checkbox" id="marriage_state" name="columns[]" value="marriage_state"> Marriage State <br>
                                                    <input type="checkbox" id="email" name="columns[]" value="email"> Email <br>
                                                    <input type="checkbox" id="contact_no_mobile" name="columns[]" value="contact_no_mobile"> Contact No Mobile <br>
                                                    <input type="checkbox" id="contact_no_home" name="columns[]" value="contact_no_home"> Contact No Home <br>
                                                    <input type="checkbox" id="home_address_1" name="columns[]" value="home_address_1"> Home Address 1 <br>
                                                    <input type="checkbox" id="home_address_2" name="columns[]" value="home_address_2"> Home Address 2 <br>
                                                    <input type="checkbox" id="home_address_3" name="columns[]" value="home_address_3"> Home Address 3 <br>
                                                    <input type="checkbox" id="current_address_1" name="columns[]" value="current_address_1"> Current Address 1 <br>                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="current_address_2" name="columns[]" value="current_address_2"> Current Address 2 <br>
                                                    <input type="checkbox" id="current_address_3" name="columns[]" value="current_address_3"> Current Address 3 <br>
                                                    <input type="checkbox" id="fb_url" name="columns[]" value="fb_url"> FB Profile<br>
                                                    <input type="checkbox" id="linkedin_url" name="columns[]" value="linkedin_url"> Linkedin Profile <br>
                                                    <input type="checkbox" id="father_name" name="columns[]" value="father_name"> Father Name<br>
                                                    <input type="checkbox" id="father_occupation" name="columns[]" value="father_occupation"> Father Occupation <br>
                                                    <input type="checkbox" id="mother_name" name="columns[]" value="mother_name"> Mother Name <br>
                                                    <input type="checkbox" id="mother_occupation" name="columns[]" value="mother_occupation"> Mother Occupation <br>
                                                    <input type="checkbox" id="number_of_sisters_and_brothers" name="columns[]" value="number_of_sisters_and_brothers"> Number of Sister and Brothers <br>
                                                    <input type="checkbox" id="dissertation_title" name="columns[]" value="dissertation_title"> Dissertation Title <br>                                                
                                                    </div>
                                                </div>   
                                                <div class="col-lg-3">  
                                                    <div class="row">
                                                    <input type="checkbox" id="dissertation_published_link" name="columns[]" value="dissertation_published_link"> Dissertation Published Link<br>
                                                    <input type="checkbox" id="supervisor_name" name="columns[]" value="supervisor_name"> Supervisor Name<br>
                                                    <input type="checkbox" id="profile_picture" name="columns[]" value="profile_picture"> Profile Picture <br>
                                                    <input type="checkbox" id="bio" name="columns[]" value="bio"> Bio <br>                                                             
                                                    </div>
                                                </div>                     
                                        </div>                    
                                    </div> {{-- End well --}}

                                <input type="hidden" id="export_type_4" name="export_type" value="">

                                <script>
                                    //export_type set as true
                                    $("#pdf_4").click(function(){
                                        $("#export_type_4").attr("value","pdf");
                                    });
                                    
                                    //export_type set as false
                                    $("#excel_4").click(function(){
                                        $("#export_type_4").attr("value","excel");
                                    });                       
                                </Script>

                                {!!Form::close()!!}
                        </div>

                        {{-- Assigned subjects of a student --}}
                        <div class="jumbotron">
                                {!! Form::open(['action' =>'ReportsController@assignedSubjectsOfStudent' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  

                                <p>Assigned subjects of a student :
                                    <button id="pdf_11" class="btn btn-primary pull-right">PDF</button>
                                    <button id="excel_11" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>

                                </p>
                                <hr>

                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="academic_year_id">Student Registration Number<span class="req"> *</span></label>
                                    <div class="controls col-sm-9">
                                        <input type="text" class="form-control" id="student_registration_number" name="student_registration_number" placeholder="Student registration number" required>
                                    </div>
                                </div>
                                

                                
                                <input type="hidden" id="export_type_11" name="export_type" value="">

                                <script>
                                    //export_type set as true
                                    $("#pdf_11").click(function(){
                                        $("#export_type_11").attr("value","pdf");
                                    });
                                    
                                    //export_type set as false
                                    $("#excel_11").click(function(){
                                        $("#export_type_11").attr("value","excel");
                                    });                       
                                </Script>

                                {!!Form::close()!!}
                        </div>

                            </div> {{-- End panel body --}}
                          </div>
                        </div>

                        {{-- Lecture Details --}}
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Lecturers Details</a>
                            </h4>
                          </div>
                          <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">

                                {{-- All the lectures in faculty --}}
                                <div class="jumbotron">
                                        {!! Form::open(['action' =>'ReportsController@allLecturesInFaculty' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}
                                          <p>All the lecturers in the faculty :
                                            <button type="submit" id="pdf_5" class="btn btn-primary pull-right">PDF</button>
                                            <button type="submit" id="excel_5" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>
        
                                            <button type="button" id="show_5" class="btn btn-default pull-right" style="margin-right:5px">Select Columns</button>
        
                                          </p>
                                          <hr>
                                            
        
                                          <div id="well_5" class="well" style="display:none">
                                            <div class="row">
                                                <div class="col-lg-3">  
                                                    <div class="row" style="margin-left:10px">
                                                            <input type="checkbox" id="employee_id" name="columns[]" value="employee_id" checked> Employee ID <br>
                                                            <input type="checkbox" id="department_id" name="columns[]" value="department_id" checked> Department <br>
                                                            <input type="checkbox" id="initials" name="columns[]" value="initials" checked> Initials <br>                                                                                                           
                                                    </div>
                                                </div>   
                                                <div class="col-lg-3">  
                                                    <div class="row">
                                                            <input type="checkbox" id="first_name" name="columns[]" value="first_name" checked> First Name <br>
                                                            <input type="checkbox" id="last_name" name="columns[]" value="last_name" checked>Last Name <br>
                                                            <input type="checkbox" id="email" name="columns[]" value="email" checked> Email<br>                                                                                                                                                           
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">  
                                                        <div class="row">
                                                            <input type="checkbox" id="mobile" name="columns[]" value="mobile" checked> Mobile <br>
                                                            <input type="checkbox" id="gender" name="columns[]" value="gender" checked> Gender <br>
                                                            <input type="checkbox" id="qualifications" name="columns[]" value="qualifications"> Qualifications <br>
                                                        </div>
                                                    </div>   
                                                <div class="col-lg-3">  
                                                    <div class="row">
                                                        <input type="checkbox" id="profile_picture" name="columns[]" value="profile_picture"> Profile Picture <br>
                                                        <input type="checkbox" id="bio" name="columns[]" value="bio"> Bio <br>                                                                                             
                                                    </div>
                                                </div>                     
                                            </div>                    
                                        </div> {{-- End well --}}
        
                                          <input type="hidden" id="export_type_5" name="export_type" value="">
        
                                          <script>
                                              //export_type set as true
                                              $("#pdf_5").click(function(){
                                                  $("#export_type_5").attr("value","pdf");
                                              });
                                              
                                              //export_type set as false
                                              $("#excel_5").click(function(){
                                                  $("#export_type_5").attr("value","excel");
                                              });                       
                                          </Script>
        
                                          {!!Form::close()!!}
                                      </div>

                                      {{-- Lectures in specific deartment --}}
                                      <div class="jumbotron">
                                            {!! Form::open(['action' =>'ReportsController@lecturesInSpecificDepartment' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  
            
                                            <p>Lecturers in specific department :
                                                <button id="pdf_6" class="btn btn-primary pull-right">PDF</button>
                                                <button id="excel_6" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>
            
                                                <button type="button" id="show_6" class="btn btn-default pull-right" style="margin-right:5px">Select Columns</button>
            
                                            </p>
                                            <hr>
            
                                            
                                            <div class="form-group">
                                                <label class="control-label control-label-left col-sm-3" for="department_id">Select Department<span class="req"> *</span></label>
                                                <div class="controls col-sm-9">
                                                    <select id="department_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-role="select" selected="selected" required="required" name="department_id">
                                                        @foreach($departments as $department)
                                                            <option value="{{$department->department_id}}">
                                                                {{$department->name}}
                                                            </option>                                                
                                                        @endforeach 
                                                    </select>                                        
                                                </div>
                                            </div>
            
                                            <div id="well_6" class="well" style="display:none">
                                                    <div class="row">
                                                        <div class="col-lg-3">  
                                                            <div class="row" style="margin-left:10px">
                                                                    <input type="checkbox" id="employee_id" name="columns[]" value="employee_id" checked> Employee ID <br>
                                                                    <input type="checkbox" id="department_id" name="columns[]" value="department_id" checked> Department <br>
                                                                    <input type="checkbox" id="initials" name="columns[]" value="initials" checked> Initials <br>                                                                                                           
                                                            </div>
                                                        </div>   
                                                        <div class="col-lg-3">  
                                                            <div class="row">
                                                                    <input type="checkbox" id="first_name" name="columns[]" value="first_name" checked> First Name <br>
                                                                    <input type="checkbox" id="last_name" name="columns[]" value="last_name" checked>Last Name <br>
                                                                    <input type="checkbox" id="email" name="columns[]" value="email" checked> Email<br>                                                                                                                                                           
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">  
                                                                <div class="row">
                                                                    <input type="checkbox" id="mobile" name="columns[]" value="mobile" checked> Mobile <br>
                                                                    <input type="checkbox" id="gender" name="columns[]" value="gender" checked> Gender <br>
                                                                    <input type="checkbox" id="qualifications" name="columns[]" value="qualifications"> Qualifications <br>
                                                                </div>
                                                            </div>   
                                                        <div class="col-lg-3">  
                                                            <div class="row">
                                                                <input type="checkbox" id="profile_picture" name="columns[]" value="profile_picture"> Profile Picture <br>
                                                                <input type="checkbox" id="bio" name="columns[]" value="bio"> Bio <br>                                                                                             
                                                            </div>
                                                        </div>                     
                                                    </div>                    
                                                </div> {{-- End well --}}
            
                                            <input type="hidden" id="export_type_6" name="export_type" value="">
            
                                            <script>
                                                //export_type set as true
                                                $("#pdf_6").click(function(){
                                                    $("#export_type_6").attr("value","pdf");
                                                });
                                                
                                                //export_type set as false
                                                $("#excel_6").click(function(){
                                                    $("#export_type_6").attr("value","excel");
                                                });                       
                                            </Script>
            
                                            {!!Form::close()!!}
                                    </div> 

                                    {{-- Show assigned subjects of specific lecture --}}
                                    <div class="jumbotron">
                                            {!! Form::open(['action' =>'ReportsController@assignedSubjectsOfSpecificLecture' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  
            
                                            <p>Assigned subjects of specific lecturer :
                                                <button id="pdf_7" class="btn btn-primary pull-right">PDF</button>
                                                <button id="excel_7" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>            
                                            </p>
                                            <hr>
            
                                            
                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Academic Year<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="academic_year_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-role="select" required="required" selected="selected" name="academic_year_id">
                                                            @foreach($academicYears as $academicYear)
                                                                <option value="{{$academicYear->academic_year_id}}">
                                                                    {{$academicYear->year}}
                                                                </option>                                                
                                                            @endforeach                                                
                                                        </select>
                                                    </div>
                                            </div>
                                            

                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="employee_id">Employee ID<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                            <input type="text" class="form-control" id="employee_id" placeholder="Enter Employee ID" name="employee_id" required>
                                       
                                                    </div>
                                            </div>
            
                                            
            
                                            <input type="hidden" id="export_type_7" name="export_type" value="">
            
                                            <script>
                                                //export_type set as true
                                                $("#pdf_7").click(function(){
                                                    $("#export_type_7").attr("value","pdf");
                                                });
                                                
                                                //export_type set as false
                                                $("#excel_7").click(function(){
                                                    $("#export_type_7").attr("value","excel");
                                                });                       
                                            </Script>
            
                                            {!!Form::close()!!}
                                    </div>

                                    

                            </div> {{--End panel --}}
                          </div>
                        </div>

                        {{-- Results --}}
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                             Results</a>
                            </h4>
                          </div>
                          <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">

                                    {{-- Full results of a specific student --}}
                                    <div class="jumbotron">
                                            {!! Form::open(['action' =>'ReportsController@fullResultsOfSpecificStudent' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  
            
                                            <p>Full results of a student :
                                                <button id="pdf_8" class="btn btn-primary pull-right">PDF</button>
                                            </p>
                                            <hr>                                                                                            

                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="student_registration_number">Student Registration Number<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                            <input type="text" class="form-control" id="student_registration_number" placeholder="Enter student registration number" name="student_registration_number" required>                                       
                                                    </div>
                                            </div>
            
            
                                            <input type="hidden" id="export_type_8" name="export_type" value="pdf">                                            
            
                                            {!!Form::close()!!}
                                    </div>

                                    {{-- Subject Results --}}
                                    <div class="jumbotron">
                                            {!! Form::open(['action' =>'ReportsController@subjectResults' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  
            
                                            <p>Subject results :
                                                <button id="pdf_9" class="btn btn-primary pull-right">PDF</button>
                                                <button id="excel_9" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>                
                                            </p>
                                            <hr>                                                                                            

                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="subject_code">Select Subject<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="subject_code" class="form-control selectpicker" data-live-search="true"  data-size="5"data-role="select" selected="selected" required="required" name="subject_code">
                                                            @foreach($subjects as $subject)
                                                                <option value="{{$subject->subject_code}}">
                                                                        {{$subject->subject_code}}-{{$subject->title}}
                                                                </option>                                                
                                                            @endforeach 
                                                        </select>                                        
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="exam_year">Select Exam Year<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="exam_year" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" selected="selected" required="required" name="exam_year">
                                                            @foreach($examYears as $examYear)
                                                                <option value="{{$examYear->exam_year}}">
                                                                    {{$examYear->exam_year}}
                                                                </option>                                                
                                                            @endforeach 
                                                        </select>                                        
                                                    </div>
                                            </div>

                                                                                                    
            
                                            <input type="hidden" id="export_type_9" name="export_type" value="">
            
                                            <script>
                                                //export_type set as true
                                                $("#pdf_9").click(function(){
                                                    $("#export_type_9").attr("value","pdf");
                                                });
                                                
                                                //export_type set as false
                                                $("#excel_9").click(function(){
                                                    $("#export_type_9").attr("value","excel");
                                                });                       
                                            </Script>
            
                                            {!!Form::close()!!}
                                    </div>

                                    {{-- Semester Results --}}
                                    <div class="jumbotron">
                                            {!! Form::open(['action' =>'ReportsController@semesterResults' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  
            
                                            <p>Semester results :
                                                <button id="pdf_10" class="btn btn-primary pull-right">PDF</button>
                                                <button id="excel_10" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>                
                                            </p>
                                            <hr>                                                                                            

                                            <div class="form-group">
                                                <label class="control-label control-label-left col-sm-3" for="exam_year">Select Exam Year<span class="req"> *</span></label>
                                                <div class="controls col-sm-9">
                                                    <select id="exam_year" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" selected="selected" required="required" name="exam_year">
                                                        @foreach($examYears as $examYear)
                                                            <option value="{{$examYear->exam_year}}">
                                                                {{$examYear->exam_year}}
                                                            </option>                                                
                                                        @endforeach 
                                                    </select>                                        
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="course_id">Select Course<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="course_id" class="form-control selectpicker" data-live-search="true"  data-size="5"data-role="select" selected="selected" required="required" name="course_id">
                                                            @foreach($courses as $course)
                                                                <option value="{{$course->course_id}}">
                                                                    {{$course->name}}
                                                                </option>                                                
                                                            @endforeach 
                                                        </select>                                        
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="year">Select Year<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="year" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" selected="selected" required="required" name="year">
                                                                <option value="1">
                                                                    Year 1
                                                                </option>
                                                                <option value="2">
                                                                    Year 2
                                                                </option>    
                                                                <option value="3">
                                                                    Year 3
                                                                </option> 
                                                                <option value="4">
                                                                    Year 4
                                                                </option>                                              
                                                        </select>                                        
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="semester">Select Semester<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="semester" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" selected="selected" required="required" name="semester">
                                                                <option value="1">
                                                                    Semester 1
                                                                </option>
                                                                <option value="2">
                                                                    Semester 2
                                                                </option>                                                                                                              
                                                        </select>                                        
                                                    </div>
                                            </div>

                                                                                                    
            
                                            <input type="hidden" id="export_type_10" name="export_type" value="">
            
                                            <script>
                                                //export_type set as true
                                                $("#pdf_10").click(function(){
                                                    $("#export_type_10").attr("value","pdf");
                                                });
                                                
                                                //export_type set as false
                                                $("#excel_10").click(function(){
                                                    $("#export_type_10").attr("value","excel");
                                                });                       
                                            </Script>
            
                                            {!!Form::close()!!}
                                    </div>
                                
                            </div>
                          </div>
                        </div>
                        

                        {{-- Course Details --}}
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                   Course Details</a>
                                  </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                  <div class="panel-body">

                                        {{-- Course Details --}}
                                        <div class="jumbotron">
                                                {!! Form::open(['action' =>'ReportsController@courseDetails' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  
                
                                                <p>Course details :
                                                    <button id="pdf_12" class="btn btn-primary pull-right">PDF</button>
                                                    <button id="excel_12" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>                        
                                                </p>
                                                <hr>
                                                
                                                <div class="form-group">
                                                    <label class="control-label control-label-left col-sm-3" for="course_id">Course<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="course_id" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" selected="selected" required="required" name="course_id">
                                                            @foreach($courses as $course)
                                                                <option value="{{$course->course_id}}">
                                                                    {{$course->name}}
                                                                </option>                                                
                                                            @endforeach 
                                                        </select>                                        
                                                    </div>
                                                </div>
                
                                                <input type="hidden" id="export_type_12" name="export_type" value="">
                
                                                <script>
                                                    //export_type set as true
                                                    $("#pdf_12").click(function(){
                                                        $("#export_type_12").attr("value","pdf");
                                                    });
                                                    
                                                    //export_type set as false
                                                    $("#excel_12").click(function(){
                                                        $("#export_type_12").attr("value","excel");
                                                    });                       
                                                </Script>
                
                                                {!!Form::close()!!}
                                        </div> 
                                        
                                       


                                                                              
                                   </div> {{-- End panel --}}
                                </div>
                        </div>

                        {{-- Grading System --}}
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                            Grading System </a>
                                  </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                  <div class="panel-body">     

                                     {{-- Grading System --}}
                                     <div class="jumbotron">
                                            {!! Form::open(['action' =>'ReportsController@gradingSystem' , 'method' => 'POST',  'class'=> 'form-horizontal']) !!}                                  
            
                                            <p>Grading details :
                                                <button id="pdf_13" class="btn btn-primary pull-right">PDF</button>
                                                <button id="excel_13" class="btn btn-primary pull-right" style="margin-right:5px">Excel</button>                        
                                            </p>
                                            <hr>                                                                                                                                                                            
            
                                            <input type="hidden" id="export_type_13" name="export_type" value="">
            
                                            <script>
                                                //export_type set as true
                                                $("#pdf_13").click(function(){
                                                    $("#export_type_13").attr("value","pdf");
                                                });
                                                
                                                //export_type set as false
                                                $("#excel_13").click(function(){
                                                    $("#export_type_13").attr("value","excel");
                                                });                       
                                            </Script>
            
                                            {!!Form::close()!!}
                                    </div>                                         
                                  </div>
                                </div>
                        </div>


                </div> 
                {{-- End - panel group --}}                
                        
        </div>

    </div>        

<script> 
    $(document).ready(function(){

        $("#show_0").click(function(){
            $("#well_0").slideToggle("slow");
        });

        $("#show_1").click(function(){
            $("#well_1").slideToggle("slow");
        });

        $("#show_2").click(function(){
            $("#well_2").slideToggle("slow");
        });

        $("#show_3").click(function(){
            $("#well_3").slideToggle("slow");
        });

         $("#show_4").click(function(){
            $("#well_4").slideToggle("slow");
        });

        $("#show_5").click(function(){
            $("#well_5").slideToggle("slow");
        });

        $("#show_6").click(function(){
            $("#well_6").slideToggle("slow");
        });

        
    });
</script>

@endsection