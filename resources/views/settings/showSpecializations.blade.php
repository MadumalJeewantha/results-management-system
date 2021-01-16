@extends('layouts.dashboard')

@section('content')

<script>                                                                                                      
    $(document).ready(function(){
       //Change event of specialized area 
       $("#specialized_area_id").change(function () {
        
        //Get the selected value
        var selectedValue = $(this).val();                                 

        //Loop through values of select  
        $('#specialized_area_id > option').each(function() {
            //Hide via jQuery
            $("#specializedArea"+$(this).val()).hide();          
        });

        //Show via jQuery
        $("#specializedArea"+selectedValue).show();
        
        });
    });                               
</script> 

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">                                                                                                                                              
                Students  
                {!! Form::open(['action' =>'SettingsController@showStudentsSettingsPage' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}                    
                    <input type="hidden" name="academic_year_id" value="{{$student->academic_year_id}}">
                    <input type="hidden" name="course_id" value="{{$student->course_id}}">            
                    <input type="submit" value="Back" class="btn btn-default pull-right" style="margin:5px;">
                {!! Form::close() !!}
            </h1>
            <h3>
                Name: <strong>{{$student->initials .' ' . $student->first_name . ' ' . $student->last_name}}</strong><br>
                Registration No: <strong>{{$student->student_registration_number}}</strong><br>
                Course: <strong>{{$student->course->name}}</strong>

            </h3>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li>
                        <i class="glyphicon glyphicon-cog"></i> <a href="/settings">Settings</a>
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-user"></i> Students
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-eye-open"></i> Show Students
                    </li>
                    <li class="active">
                        <i class="glyphicon glyphicon-pencil"></i> Assign Specialization
                    </li>                      
                </ol>
        </div>

        <div class="col-lg-12">
                
            <div class="panel panel-default">
                <div class="panel-body">
                    <strong>
                    <p>Please select Department and Specialization for the student. According to the selection, subjects will be display.</p>
                    <p>Note: Common subjects will not show here. It will be configured automatically.</p>
                    </strong>
                    <hr>
                {!! Form::open(['action' => ['SettingsController@config',$student->student_registration_number ] , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
                
                <div class="col-lg-8">
                    <!--department_id-->
                    <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                            <label class="control-label control-label-left col-sm-3" for="department_id">Department<span class="req">*</span> </label>
                            <div class="controls col-sm-9">
                                <select id="department_id" class="form-control" data-role="select" selected="selected" name="department_id" required>
                                    
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

                    <!--specialized_area_id-->
                    <div class="form-group{{ $errors->has('specialized_area_id') ? ' has-error' : '' }}">
                            <label class="control-label control-label-left col-sm-3" for="specialized_area_id">Specialized Area<span class="req">*</span></label>
                            <div class="controls col-sm-9">
                                <select id="specialized_area_id" class="form-control" data-role="select" selected="selected" name="specialized_area_id" required>
                                
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

                <div class="col-lg-12">
                {{-- Show subjects --}}
                {{-- Specialization begins at third year --}}

                @foreach($specializedAreas as $specializedArea)

                @if($specializedArea->name == "Not Specified")
                    @continue
                @endif
                        
                        <div class="well subject-content" style="{{($student->specialized_area_id == $specializedArea->specialized_area_id) ? 'display:block' : 'display:none' }}" id="specializedArea{{$specializedArea->specialized_area_id}}">
                        <h3><strong>Specialized Area: {{$specializedArea->name}}</strong></h3>
                        <br>
                            {{-- Year 3 Semester 1 --}}
                            <h4>Year 3 - Semester 1</h4>                    
                            <table class="table table-striped table-bordered table-hover">
                                
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Title</th>
                                        <th>Credits</th>
                                        <th>Status</th>
                                        <th>Conducted By</th>
                                        <th>Select</th>
                                    </tr>

                                    {{-- Loop through all subjects --}}
                                    @foreach($subjects as $subject)
                                            @if($subject->course_id == $student->course_id &&  $subject->year == '3' && $subject->semester == '1' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                            <tr>    
                                                <td>{{$subject->subject_code}}</td>
                                                <td>{{$subject->title}}</td>
                                                <td>{{$subject->credits}}</td>
                                                <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                <td>{{$subject->department->name}} Department</td>

                                                <td>                                                    
                                                    {{-- Show checkbox --}}
                                                    {{-- If the subject has added to student, it should display here --}}
                                                    <?php $hint = '0'?>
                                                    @foreach($student_subjects as $student_subject) 
                                                        {{-- Find whether subjects are matched --}}
                                                        @if($student_subject->subjects_subject_code == $subject->subject_code) 
                                                            <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}" checked>
                                                            <?php $hint = '1' ?>                                                            
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if($hint == '0')
                                                        <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}">                                                            
                                                    @endif
                                                </td> 

                                            </tr>
                                            @endif
                                    @endforeach                                 
                            </table>
                            {{-- End Year 3 Semester 1 --}}

                            {{-- Year 3 Semester 2 --}}
                            <h4>Year 3 - Semester 2</h4>                    
                            <table class="table table-striped table-bordered table-hover">

                                <tr>
                                        <th>Subject Code</th>
                                        <th>Title</th>
                                        <th>Credits</th>
                                        <th>Status</th>
                                        <th>Conducted By</th>
                                        <th>Select</th>
                                    </tr>

                                    @foreach($subjects as $subject)
                                            @if($subject->course_id == $student->course_id &&  $subject->year == '3' && $subject->semester == '2' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                            <tr>    
                                                <td>{{$subject->subject_code}}</td>
                                                <td>{{$subject->title}}</td>
                                                <td>{{$subject->credits}}</td>
                                                <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                <td>{{$subject->department->name}} Department</td>

                                                <td>                                                    
                                                    {{-- Show checkbox --}}
                                                    {{-- If the subject has added to student, it should display here --}}
                                                    <?php $hint = '0'?>
                                                    @foreach($student_subjects as $student_subject) 
                                                        {{-- Find whether subjects are matched --}}
                                                        @if($student_subject->subjects_subject_code == $subject->subject_code)
                                                            <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}" checked>
                                                            <?php $hint = '1' ?>                                                            
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if($hint == '0')
                                                        <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}">                                                            
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                    @endforeach                                 
                            </table>
                            {{-- End Year 3 Semester 2 --}}

                            {{-- Year 4 Semester 1 --}}
                            <h4>Year 4 - Semester 1</h4>                    
                            <table class="table table-striped table-bordered table-hover">

                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Title</th>
                                        <th>Credits</th>
                                        <th>Status</th>
                                        <th>Conducted By</th>
                                        <th>Select</th>
                                    </tr>

                                    @foreach($subjects as $subject)
                                            @if($subject->course_id == $student->course_id &&  $subject->year == '4' && $subject->semester == '1' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                            <tr>    
                                                <td>{{$subject->subject_code}}</td>
                                                <td>{{$subject->title}}</td>
                                                <td>{{$subject->credits}}</td>
                                                <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                <td>{{$subject->department->name}} Department</td>

                                                <td>                                                    
                                                        {{-- Show checkbox --}}
                                                        {{-- If the subject has added to student, it should display here --}}
                                                        <?php $hint = '0'?>
                                                        @foreach($student_subjects as $student_subject) 
                                                            {{-- Find whether subjects are matched --}}
                                                            @if($student_subject->subjects_subject_code == $subject->subject_code)
                                                                <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}" checked>
                                                                <?php $hint = '1' ?>                                                            
                                                            @endif
                                                        @endforeach
                                                        
                                                        @if($hint == '0')
                                                            <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}">                                                            
                                                        @endif
                                                </td> 
                                            </tr>
                                            @endif
                                    @endforeach                                 
                            </table>
                            {{-- End Year 4 Semester 1 --}}

                            {{-- Year 4 Semester 2 --}}
                            <h4>Year 4 - Semester 2</h4>                    
                            <table class="table table-striped table-bordered table-hover">
                                
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Title</th>
                                        <th>Credits</th>
                                        <th>Status</th>
                                        <th>Conducted By</th>
                                        <th>Select</th>
                                    </tr>

                                    @foreach($subjects as $subject)
                                            @if($subject->course_id == $student->course_id &&  $subject->year == '4' && $subject->semester == '2' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                            <tr>    
                                                <td>{{$subject->subject_code}}</td>
                                                <td>{{$subject->title}}</td>
                                                <td>{{$subject->credits}}</td>
                                                <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                <td>{{$subject->department->name}} Department</td>

                                                <td>                                                    
                                                        {{-- Show checkbox --}}
                                                        {{-- If the subject has added to student, it should display here --}}
                                                        <?php $hint = '0'?>
                                                        @foreach($student_subjects as $student_subject) 
                                                            {{-- Find whether subjects are matched --}}
                                                            @if($student_subject->subjects_subject_code == $subject->subject_code)
                                                                <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}" checked>
                                                                <?php $hint = '1' ?>                                                            
                                                            @endif
                                                        @endforeach
                                                        
                                                        @if($hint == '0')
                                                            <input type="checkbox" id="{{$subject->subject_code}}" name="subjects[]" value="{{$subject->subject_code}}">                                                            
                                                        @endif
                                                </td>
                                            </tr>
                                            @endif
                                    @endforeach                                 
                            </table>
                            {{-- End Year 4 Semester 2 --}}

                        </div>

                        @endforeach

                    <input type="submit" value="Update" class="btn btn-primary pull-right" style="margin:5px"> 

                    {!! Form::open(['action' =>'SettingsController@showStudentsSettingsPage' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}                    
                    <input type="hidden" name="academic_year_id" value="{{$student->academic_year_id}}">
                    <input type="hidden" name="course_id" value="{{$student->course_id}}">            
                    <input type="submit" value="Back" class="btn btn-default pull-left" style="margin:5px">
                    {!! Form::close() !!}

                    </div>
                        

                {{-- {{Form::hidden('_method', 'PUT')}} --}}
                {!! Form::close() !!}                                        

            </div>  
                    
        </div>

        </div>
</div>
{{-- end row --}}
   
@endsection