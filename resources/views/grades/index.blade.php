@extends('layouts.dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Results Viewer  <a href="/dashboard" class="btn btn-default pull-right">Back</a>           
        </h1>

        <ol class="breadcrumb">
            <li>
                <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-text-background"></i> Results
            </li>                     
        </ol>
    </div>



    <div class="col-lg-12">


            @if( Auth::user()->type == 'examination_branch')

            <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{-- Publish results --}}
                                        <div id="panel1" style="height:1160.4px; overflow:auto;" class="panel panel-default">
                                            <div class="panel-heading">Publish Results</div>                    

                                            <div class="panel-body">
                                                {{-- Get distinct sujects with exam_year from grades if published state false --}}                                               

                                                <div class="list-group">
                                                    @foreach($attentions as $attention)
                                                        <button id="publish_results" class="list-group-item list-group-item-warning publish-modal" data-subject_code="{{$attention->subject_code}}" data-title="{{App\Subject::find($attention->subject_code)->title}}" data-exam_year="{{$attention->exam_year}}">{{$attention->subject_code}}-{{App\Subject::find($attention->subject_code)->title}} in exam year {{$attention->exam_year}}</button> 
                                                    @endforeach                                                   
                                                </div>                                             
                                            </div>
                                        </div> 
                                </div>
                            </div>
            
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{-- Add new results --}}
                                            <div id="panel2" class="panel panel-default">
                                                <div class="panel-heading">Add New Results</div>                    

                                                <div class="panel-body">

                                                    {!! Form::open(['action' =>'GradesController@showStudentsToStore' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}                

                                                    <div class="form-group">
                                                        {{-- subject --}}                                    
                                                        <label class="control-label control-label-left col-sm-3" for="subject">Select Subject<span class="req"> *</span></label>
                                                        <div class="controls col-sm-9">
                                                            <select id="subject" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" name="subject">
                                                                @foreach($subjects as $subject)
                                                                    <option value="{{$subject->subject_code}}">
                                                                            {{$subject->subject_code}} - {{$subject->title}}
                                                                    </option>                                                
                                                                @endforeach                                                
                                                            </select>                       
                                                        
                                                            @if ($errors->has('subject'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('subject') }}</strong>
                                                            </span>
                                                            @endif  
                                                        </div>
                                                </div>

                                                <div class="form-group">
                                                    {{-- academic_year_id --}}                                    
                                                    <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Academic Year<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="academic_year_id" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" selected="selected" name="academic_year_id" value="{{ old('academic_year_id') }}">

                                                            @foreach($academicYears as $academicYear)
                                                            <option value="{{$academicYear->academic_year_id}}">
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
                                                <input type="submit" value="Show Students" class="btn btn-success pull-right"> 

                                                <span class="pull-left">Show list of students according to subject and academic year.</span>

                                                {!! Form::close()!!}
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-8">
                                        <div class="form-group">
                                            {{-- Import results from excel --}}
                                                    <div id="panel2" class="panel panel-default">
                                                        <div class="panel-heading">Import from Excel</div>                    
        
                                                        <div class="panel-body">
        
                                                            {!! Form::open(['action' =>'GradesController@importGrades' , 'method' => 'POST', 'class'=> 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}                
        
                                                            <div class="form-group">
                                                                {{-- subject --}}                                    
                                                                <label class="control-label control-label-left col-sm-3" for="subject">Select Subject<span class="req"> *</span></label>
                                                                <div class="controls col-sm-9">
                                                                    <select id="subject" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" name="subject">
                                                                        @foreach($subjects as $subject)
                                                                            <option value="{{$subject->subject_code}}">
                                                                                    {{$subject->subject_code}} - {{$subject->title}}
                                                                            </option>                                                
                                                                        @endforeach                                                
                                                                    </select>                       
                                                                
                                                                    @if ($errors->has('subject'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                                    </span>
                                                                    @endif  
                                                                </div>
                                                        </div>
        
                                                        <div class="form-group">
                                                            {{-- academic_year_id --}}                                    
                                                            <label class="control-label control-label-left col-sm-3" for="academic_year_id">Select Academic Year<span class="req"> *</span></label>
                                                            <div class="controls col-sm-9">
                                                                <select id="academic_year_id" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" selected="selected" name="academic_year_id" value="{{ old('academic_year_id') }}">
        
                                                                    @foreach($academicYears as $academicYear)
                                                                    <option value="{{$academicYear->academic_year_id}}">
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

                                                        <div class="form-group">
                                                            {{-- file --}}                                    
                                                            <label class="control-label control-label-left col-sm-3" for="grades_file">Select excel file<span class="req"> *</span></label>
                                                            <div class="controls col-sm-9">
                                                                <input type="file" name="file"  accept=".xlsx, .xls ">                                                                        
                                                            </div>
                                                        </div>

                                                        <span class="pull-left">Excel file format should be as follows. First column should be registration number of the student and second column should be the relevant grade. | Student Registration Number | Grade |</span>

                                                        <input type="submit" value="Process" class="btn btn-success pull-right"> 
                
                                                        {!! Form::close()!!}
                                                    </div>
                                                </div>
                                            </div>
        
                                </div>



                                <div class="col-md-8">
                                    <div class="form-group">
                                        {{-- Add repeat subject results --}}
                                                <div id="panel2" class="panel panel-default">
                                                    <div class="panel-heading">Add Repeat Subject Results</div>                    
    
                                                    <div class="panel-body">
    
                                                        {!! Form::open(['action' =>'GradesController@addRepeatSubjectResults' , 'method' => 'POST', 'class'=> 'form-horizontal' , 'id' => 'repeatSubjects' ]) !!}                
    
                                                        <div class="form-group">
                                                                {{-- student_registration_number --}}                                    
                                                                <label class="control-label control-label-left col-sm-3" for="student_registration_number">Student Registration No.<span class="req"> *</span></label>
                                                                <div class="controls col-sm-9">
                                                                    <input type="text" class="form-control" id="student_registration_number" name="student_registration_number" placeholder="Enter Student Registration Number" required>              
                                                                
                                                                    @if ($errors->has('student_registration_number'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('student_registration_number') }}</strong>
                                                                    </span>
                                                                    @endif  
                                                                </div>
                                                        </div>

                                                        <div class="form-group">
                                                            {{-- exam_year --}}                                    
                                                            <label class="control-label control-label-left col-sm-3" for="exam_year">Exam Year<span class="req"> *</span></label>
                                                            <div class="controls col-sm-9">
                                                                <input type="text" class="form-control" id="exam_year" name="exam_year" placeholder="Enter Exam Year" required>              
                                                            
                                                                @if ($errors->has('exam_year'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('exam_year') }}</strong>
                                                                </span>
                                                                @endif  
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            {{-- subject --}}                                    
                                                            <label class="control-label control-label-left col-sm-3" for="subject_code">Select Subject<span class="req"> *</span></label>
                                                            <div class="controls col-sm-9">
                                                                <select id="subject_code" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" name="subject_code">
                                                                    @foreach($subjects as $subject)
                                                                        <option value="{{$subject->subject_code}}">
                                                                                {{$subject->subject_code}} - {{$subject->title}}
                                                                        </option>                                                
                                                                    @endforeach                                                
                                                                </select>                       
                                                            
                                                                @if ($errors->has('subject_code'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('subject_code') }}</strong>
                                                                </span>
                                                                @endif  
                                                            </div>
                                                        </div>
        
                                                        <div class="form-group">
                                                            {{-- gradings --}}                                    
                                                            <label class="control-label control-label-left col-sm-3" for="grade">Select Grade<span class="req"> *</span></label>
                                                            <div class="controls col-sm-9">
                                                                <select id="grade" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" selected="selected" name="grade">
        
                                                                    @foreach($gradings as $grading)
                                                                    <option value="{{$grading->id}}">
                                                                        {{$grading->grade}}
                                                                    </option>                                                
                                                                    @endforeach                                                
                                                                </select>
        
                                                                @if ($errors->has('grade'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('grade') }}</strong>
                                                                </span>
                                                                @endif  
                                                            </div>
                                                        </div>

                                                        {{-- publish state --}}
                                                        <input type="hidden" id="publish_hint" name="publish" value="0">  
                                                        
                                                        {{-- Save button - Default --}}
                                                        <input type="submit" id="save" value="Save" class="btn btn-success pull-right" style="margin:5px">
                                                        {{-- Save & Publish button --}}
                                                        <input type="submit" id="publish" value="Save &amp; Publish" class="btn btn-primary pull-right" style="margin:5px"> 
                                                        
                                                        <script>
                                                                //Publish set as true
                                                                $("#publish").click(function(){
                                                                    $("#publish_hint").attr("value","1");
                                                                });
                                                                
                                                                //Publish set as false
                                                                $("#save").click(function(){
                                                                    $("#publish_hint").attr("value","0");
                                                                });                       
                                                        </Script>     

                                                        <span class="pull-left">This should use to add repeat subjects only.</span>
    
                                                    {!! Form::close()!!}
                                                </div>
                                            </div>
                                        </div>
    
                                </div>

                                {{-- Edit results --}}
                                <div class="col-md-8">
                                        <div class="form-group">
                                                    <div id="panel2" class="panel panel-default">
                                                        <div class="panel-heading">Edit Results</div>                    
        
                                                        <div class="panel-body">
        
                                                            {!! Form::open(['action' =>'GradesController@showStudentsToEdit' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}                
        
                                                            <div class="form-group">
                                                                {{-- subject --}}                                    
                                                                <label class="control-label control-label-left col-sm-3" for="subject">Select Subject<span class="req"> *</span></label>
                                                                <div class="controls col-sm-9">
                                                                    <select id="subject" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" name="subject">
                                                                        @foreach($subjects as $subject)
                                                                            <option value="{{$subject->subject_code}}">
                                                                                    {{$subject->subject_code}} - {{$subject->title}}
                                                                            </option>                                                
                                                                        @endforeach                                                
                                                                    </select>                       
                                                                
                                                                    @if ($errors->has('subject'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                                    </span>
                                                                    @endif  
                                                                </div>
                                                        </div>
        
                                                        <div class="form-group">
                                                            {{-- exam_year --}}                                    
                                                            <label class="control-label control-label-left col-sm-3" for="exam_year">Select Exam Year<span class="req"> *</span></label>
                                                            <div class="controls col-sm-9">
                                                                <select id="exam_year" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" selected="selected" name="exam_year">
        
                                                                    @foreach($examYears as $examYear)
                                                                    <option value="{{$examYear->exam_year}}">
                                                                        {{$examYear->exam_year}}
                                                                    </option>                                                
                                                                    @endforeach                                                
                                                                </select>
        
                                                                @if ($errors->has('exam_year'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('exam_year') }}</strong>
                                                                </span>
                                                                @endif  
                                                            </div>
                                                        </div>
                                                        <input type="submit" value="View Results" class="btn btn-primary pull-right"> 
                                                        <span class="pull-left">View list of students with results according to subject and exam year.</span>
                                                        
        
                                                        {!! Form::close()!!}
                                                    </div>
                                                </div>
                                            </div>
        
                                        </div>

                            </div>
                        </div>
                    </div>
                    @endif 


                   

                    <div class="well">
                            {{-- Start search form - POST --}}
                
                            {{-- Dropdown --}}
                            <div class="form-group">
                
                                <div class="col-md-6">
                                <h4>Search Options</h4>
                                <label class="control-label control-label-left col-sm-3" for="search_by">Search By </label>
                                <div class="controls col-sm-6">
                                    <select id="search_by" class="form-control" data-role="select" name="search_by">
                
                                        <option value="1" selected>
                                            Student Registration Number
                                        </option> 
                
                                        <option value="2">
                                            Student Index Number
                                        </option> 
                
                                        <option value="3">
                                            Subject
                                        </option>                        
                
                                        <option value="4">
                                            Student Name
                                        </option>
                
                                    </select>                                
                                </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <hr>
                            {!! Form::open(['action' =>'GradesController@search' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
                            {{-- Search By : Student Registration Number --}}
                            <div class="form-group" id="1">
                                <div class="col-md-7">
                
                                    <div class="form-group{{ $errors->has('student_registration_number') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="student_registration_number">Registration No:<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="student_registration_number" class="form-control k-textbox" data-role="text" required="required" placeholder="Search By Registration Number" name="student_registration_number" type="text">
                                            <span class="help-block">Ex:2014c015</span>
                
                                            @if ($errors->has('student_registration_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('student_registration_number') }}</strong>
                                            </span>
                                            @endif                            
                                        </div>                                       
                                    </div>
                                </div>
                                <input type="hidden" id="search_hint" name="search_hint" value="1">
                                <button class="btn btn-primary">Search <span class="glyphicon glyphicon-search"></span></button>
                            </div>                    
                            {!! Form::close() !!}
                
                            {!! Form::open(['action' =>'GradesController@search' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
                            {{-- Search By : Student Index Number --}}
                            <div class="form-group" id="2" style="display:none">
                                <div class="col-md-7">
                                    <div class="form-group{{ $errors->has('student_index_number') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="student_index_number">Index No:<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <input id="student_index_number" required="required" class="form-control k-textbox" data-role="text" placeholder="Search By Index Number" name="student_index_number" type="text" value="{{ old('student_index_number') }}">
                                            <span class="help-block">Ex:c14015</span>
                
                                            @if ($errors->has('student_index_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('student_index_number') }}</strong>
                                            </span>
                                            @endif  
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="search_hint" name="search_hint" value="2">
                                <button class="btn btn-primary">Search <span class="glyphicon glyphicon-search"></span></button>
                            </div>
                            {!!Form::close()!!}
                
                            {!! Form::open(['action' =>'GradesController@search' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
                            {{-- Search By : Subject code --}}
                            <div class="form-group" id="3" style="display:none">
                                <div class="col-md-7">
                                        <div class="form-group">
                                                <label class="control-label control-label-left col-sm-3" for="subject">Select Subject<span class="req"> *</span></label>
                                                <div class="controls col-sm-9">
                                                    <select id="subject_code" class="form-control selectpicker" data-live-search="true"  data-size="5" data-role="select" required="required" name="subject_code">
                                                        @foreach($subjects as $subject)
                                                            <option value="{{$subject->subject_code}}">
                                                                    {{$subject->subject_code}} - {{$subject->title}}
                                                            </option>                                                
                                                        @endforeach                                                
                                                    </select>                       
                                                   
                                                    @if ($errors->has('subject_code'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('subject_code') }}</strong>
                                                    </span>
                                                    @endif  
                                                </div>
                                        </div>
                
                                    <!--academic_year_id-->
                                    <div class="form-group{{ $errors->has('academic_year_id') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="academic_year_id">Academic Year<span class="req"> *</span></label>
                                        <div class="controls col-sm-9">
                                            <select id="academic_year_id" class="form-control" data-role="select" required="required" selected="selected" name="academic_year_id" value="{{ old('academic_year_id') }}">
                
                                                @foreach($academicYears as $academicYear)
                                                <option value="{{$academicYear->academic_year_id}}">
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
                                <input type="hidden" id="search_hint" name="search_hint" value="3">
                                <button class="btn btn-primary">Search <span class="glyphicon glyphicon-search"></span></button>
                            </div>                
                            {!!Form::close()!!}
                
                           
                            {!! Form::open(['action' =>'GradesController@search' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
                            {{-- Search By : Student Name --}}
                            <div class="form-group" id="4" style="display:none">
                                <div class="col-md-7">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="first_name">First Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="first_name"  class="form-control k-textbox" data-role="text" placeholder="Search By First Name" name="first_name" type="text" value="{{ old('first_name') }}">
                
                                            @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif  
                                        </div>
                                    </div>
                
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-3" for="last_name">Last Name</label>
                                        <div class="controls col-sm-9">
                                            <input id="last_name"  class="form-control k-textbox" data-role="text" placeholder="Search By Last Name" name="last_name" type="text" value="{{ old('last_name') }}">
                
                                            @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif  
                                        </div>
                                    </div>
                                </div>
                
                                <input type="hidden" id="search_hint" name="search_hint" value="4">
                                <button class="btn btn-primary">Search <span class="glyphicon glyphicon-search"></span></button>
                            </div>
                            {!! Form::close()!!}
                
                
                        </div>  
                        {{-- End well  --}}                    
            </div>




        
</div>




<script>
    $(document).ready(function () {
        //Change event of specialized area 
        $("#search_by").change(function () {

            //Get the selected value
            var selectedValue = $(this).val();

            //Loop through values of select  
            $('#search_by > option').each(function () {
                //Hide via jQuery
                $("#" + $(this).val()).hide();
            });

            //Show via jQuery
            $("#" + selectedValue).show();

        });

    });
</script> 

 <!-- Publish results Modal -->
 <div id="publishModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" >
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Do you really want to publish?</h4>
            </div>
            <div class="modal-body">
              <p class="modalTitlePublish"> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning publish" data-dismiss="modal">Publish</button>                        
            </div>
          </div>
      
        </div>
</div>

<script>
    //Publish results function
$(document).on('click', '.publish-modal', function() {
            //Get subject_code
            subject_code = $(this).data('subject_code');
            //Get title value
            title = $(this).data('title')
            //Get exam_year value
            exam_year = $(this).data('exam_year')

            //Set Modal title
            $('.modalTitlePublish').text('Publish results of '+ subject_code + '-' + title + ' in exam year ' +  exam_year);

            //Show modal
            $('#publishModal').modal('show');
        });
        $('.modal-footer').on('click', '.publish', function() {
            $.ajax({
                type: 'POST',
                url: 'grades/publishResults',
                data: {
                    //Pass current values to backend
                    '_token': $('input[name=_token]').val(),
                    'subject_code': subject_code,
                    'exam_year': exam_year, 
                    'title' : title,                  
                },

                success: function(data) {
                    toastr.success('Successfully published results of '+ subject_code + '-' + title + ' in ' +  exam_year, 'Success Alert', {timeOut: 5000});
                    location.reload(true); 
                }
            });
        });

</script>    


{{-- // Default confirm box of JavaScript --}}
<script>
    $('#repeatSubjects').submit(function() {
        var value = confirm("Are you sure?");
        return value; 
    });
</script>
@endsection





