@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {

        // $('#students').DataTable();

        $('#students').DataTable( {
            
            //Set options for export showing results
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'excel', 'pdf'
            //     ],

            //Set number of showing rows
            pageLength: 100,

        } );

    } );
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
               Students - Add Results <a href="/grades" class="btn btn-default pull-right">Back</a>                       
            </h1>
                
            <div >
                <h4>Subject: <strong>{{$subject_code}} - {{$subject_title}}</strong></h4> 
                <h4>Academic Year: <strong>{{$academic_year}}</strong></h4>
            </div>                    

            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-text-background"></i> Results
                    </li>    
                    <li class="active">
                        <i class="glyphicon glyphicon-pencil"></i> Add
                    </li>                 
            </ol>
        </div>

        <div class="col-lg-12">
                @if(count($students)> 0)
                    {{-- Start form: POST --}}
                    {!! Form::open(['action' =>'GradesController@store' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}  

                    <label class="control-label control-label-left col-sm-3" for="exam_year">Exam Year</label>
                    <div class="controls col-sm-6">
                        <input type="text" class="form-control" name="exam_year" id="exam_year" placeholder="Enter exam year" required>
                    </div>

                    <table class="table table-striped table-bordered table-hover" id="students">
                        <thead>
                            <tr>
                                <th>Registration No.</th>
                                <th>Index No.</th>
                                <th>Academic Year</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Department</th>

                                {{-- Inputs --}}
                                <th >Grade</th>
                                {{-- <th style="width:100px">Exam Year</th> --}}
                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($students as $student)                    
                                    <tr class="item{{$student->student_registration_number}}">

                                        {{-- student_registration_number --}}
                                        <td>{{$student->student_registration_number}}</td>
                                        <input type="hidden" value="{{$student->student_registration_number}}" name="student_registration_number[]">

                                        {{-- student_index_number --}}
                                        <td>{{$student->student_index_number}}</td>
                                        <input type="hidden" value="{{$student->student_index_number}}" name="student_index_number[]">

                                        {{-- academic_year_id --}}
                                        <td>{{App\AcademicYear::find($student->academic_year_id)->year}}</td>
                                        {{-- student->academicyear->year --}}

                                        {{-- first_name --}}
                                        <td>{{$student->first_name}}</td>

                                        {{-- last_name --}}
                                        <td>{{$student->last_name}}</td>

                                        {{-- course_id --}}
                                        <td>{{App\Course::find($student->course_id)->name}}</td>
                                        {{-- <td>{{$student->course->name}}</td> --}}

                                        {{-- department_id --}}
                                        <td>{{App\Department::find($student->department_id)->name}}</td>
                                        {{-- <td>{{$student->department->name}}</td> --}}

                                        {{-- Grades --}}
                                        <td>
                                            <div>
                                                    <select id="grade" class="form-control" data-role="select" required="required"  name="grade[]">
                        
                                                        @foreach($gradings as $grade)

                                                            @if(isSet($hint) && $student->grade_id == $grade->id )
                                                                <option value="{{$grade->id}}" selected>
                                                            @else
                                                                <option value="{{$grade->id}}">
                                                            @endif

                                                                    {{$grade->grade}}
                                                                </option>                                                
                                                        @endforeach    

                                                    </select>                                                                                 
                                            </div>
                                        </td>

                                        {{-- Exam year
                                        <td>
                                            <input type="text" class="form-control" name="exam_year[]" required>
                                        </td>                                         --}}

                                    </tr>
                            @endforeach
                        </tbody>
                    </table>  

                    {{-- publish state --}}
                    <input type="hidden" id="publish_hint" name="publish" value="0">  
                    {{-- Subject code  --}}
                    <input type="hidden" id="subject_code" name="subject_code" value="{{$subject_code}}">
                    {{-- Subject Title --}}
                    <input type="hidden" id="subject_title" name="subject_title" value="{{$subject_title}}">


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
                   
                {!! Form::close() !!}
                @else
                    <p class="alert alert-warning">No results found.</p>
                @endif

                    
        </div>


</div>
{{-- end row --}}
    
<script>
    // Default confirm box of JavaScript
$('form').submit(function() {
    var value = confirm("Are you sure?");
    return value; 
});
</script>

@endsection