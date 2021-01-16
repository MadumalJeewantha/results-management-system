@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {                       
        // //enable tooltips which having data-toggle="tooltip
        $('[data-toggle="tooltip"]').tooltip();
        
        

        // $('#students').DataTable();
        $('#students').DataTable( {                
            //Set number of showing rows
            pageLength: 100, 
        } );
        
        // $('#students').DataTable( {
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'copy', 'excel', 'pdf'
        //         ]
        // } );

        // //confirmation
        // $('[data-toggle=confirmation]').confirmation({
        //     rootSelector: '[data-toggle=confirmation]',
        //     // other options
        // });
} );                
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">                    
               Students - Edit Results <a href="/grades" class="btn btn-default pull-right">Back</a>                       
            </h1>
            <h4>Subject: <strong>{{$subject_code}} - {{$subject_title}}</strong></h4> 
            <h4>Exam Year: <strong>{{$exam_year}}</strong></h4>                       

            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-text-background"></i> Results
                    </li>    
                    <li class="active">
                        <i class="glyphicon glyphicon-pencil"></i> Edit
                    </li>                 
                </ol>
        </div>

        <div class="col-lg-12">
                @if(count($grades)> 0)
                    {{-- Start form: POST --}}
                    {!! Form::open(['action' =>'GradesController@updateGrades' , 'method' => 'POST', 'class'=> 'form-horizontal' , 'id' => 'grades_form']) !!}                
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

                                {{-- Grade --}}
                                <th >Grade</th>
                                {{-- Exam Year --}}
                                <th style="width:100px">Exam Year</th>

                                {{-- Published --}}
                                <th>Published</th>
                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($grades as $grade)                    
                                    <tr class="item{{$grade->student_registration_number}}">

                                        {{-- student_registration_number --}}
                                        <td>
                                            {{$grade->student_registration_number}}
                                            <input type="hidden" value="{{$grade->id}}" name="id[]">
                                            <input type="hidden" value="{{$grade->student_registration_number}}" name="student_registration_number[]">
                                        </td>

                                        {{-- student_index_number --}}
                                        <td>
                                            {{$grade->student_index_number}}
                                        </td>

                                        {{-- academic_year_id --}}
                                        <td>{{App\Student::find($grade->student_registration_number)->academicyear->year}}</td>

                                        {{-- first_name --}}
                                        <td>{{App\Student::find($grade->student_registration_number)->first_name}}</td>

                                        {{-- last_name --}}
                                        <td>{{App\Student::find($grade->student_registration_number)->last_name}}</td>

                                        {{-- course_id --}}
                                        <td>{{App\Student::find($grade->student_registration_number)->course->name}}</td>

                                        {{-- department_id --}}
                                        <td>{{App\Student::find($grade->student_registration_number)->department->name}}</td>


                                        {{-- Grades --}}
                                        <td>
                                            <div>
                                                <select id="grade" class="form-control" data-role="select" required="required"  name="grade[]">
                    
                                                    @foreach($gradings as $grading)
                                                        <option value="{{$grading->id}}" {{($grade->grade == $grading->id)? 'selected' : '' }}>
                                                            {{$grading->grade}}
                                                        </option>                                                
                                                    @endforeach    

                                                </select>                                                                                 
                                            </div>                                            
                                        </td>

                                        {{-- Exam year --}}
                                        <td>
                                            <input type="text" class="form-control" name="exam_year[]" value="{{$grade->exam_year}}" required>
                                        </td>
                                        
                                        {{-- Published --}}
                                        <td>
                                            @if($grade->published == true)
                                                <span>Yes</span>
                                            @else
                                                <span>No</span>
                                            @endif
                                            {{-- <input type="checkbox" name="published[]" value="{{($grade->published == true)? '1' : '0'}}" {{($grade->published == true)? 'checked' : ''}} >                                            --}}
                                        </td>

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
                    {{-- <input type="submit" id="save"  data-toggle="confirmation" data-title="Warning" data-content="This will update all the changes and make all published results as unpublish!" value="Update" class="btn btn-success pull-right" style="margin:5px"> --}}
                    <input type="submit" id="save" data-toggle="tooltip" data-delay='{ "show": 500, "hide": 100 }' title="This will update all the changes and make all published results as unpublish!" value="Update" class="btn btn-success pull-right" style="margin:5px">
                                                           

                    {{-- Save & Publish button --}}
                    {{-- <input type="submit" id="publish" data-toggle="confirmation" data-title="Warning" data-content="This will update all the changes and make all unpublished results as publish!" value="Update &amp; Publish" class="btn btn-primary pull-right" style="margin:5px">  --}}
                    <input type="submit" id="publish" data-toggle="tooltip" data-delay='{ "show": 500, "hide": 100 }' title="This will update all the changes and make all unpublished results as publish!" value="Update &amp; Publish" class="btn btn-primary pull-right" style="margin:5px"> 
                    
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
// Manage confirmation 
//To use this should have AJAX to post the data
// alertBox - Confirmation Plugin

//Grab the all data from the form
// var formEl = $(this);
// data: formEl.serialize();

// $("#grades_form").on("submit", function(e) {

//        //Hold the submit 
//        e.preventDefault();

//         $.ajax({
//             type: 'POST',

//             beforeSend:function(){

//                 $('body').alertBox({
//                     title: 'Are you sure?',
                    
//                     lTxt: 'Cancel',
//                     lCallback: function(){
//                         return false;
//                     },

//                     rTxt: 'Confirm',
//                     rCallback: function(){
//                         return true;
//                     },
//                 });
                
//                 // return alert(action);
//                 // return confirm("Are you sure?");
//             },
//             url: "{{ url('/grades/updateResults') }}",
//             data: {
//                 //Pass current values to backend
//                 '_token': $('input[name=_token]').val(),

//                 'id': $('#id').val(),
//                 'student_registration_number': $('#student_registration_number').val(),
//                 'grade': $('#grade').val(),
//                 'exam_year': $('#exam_year').val(),
//                 'publish': $('#publish').val(),
//                 'subject_code': $('#subject_code').val(),
//                 'subject_title': $('#subject_title').val(),
//             },
//         }); 

       
//     //     $('body').alertBox({
//     //         title: 'Are you sure?',
            
//     //         lTxt: 'Cancel',
//     //         lCallback: function(){
//     //             return false;
//     //         },

//     //         rTxt: 'Confirm',
//     //         rCallback: function(){
                      
//     //             alert('in');

//     //             // Submit data
//     //             $.ajax({
//     //                 type: 'POST',
//     //                 // beforeSend:function(){
//     //                 //     return confirm("Are you sure?");
//     //                 // },
//     //                 url: "{{ url('/grades/updateResults') }}",
//     //                 data: {
//     //                     //Pass current values to backend
//     //                     '_token': $('input[name=_token]').val(),

//     //                     'id': $('#id').val(),
//     //                     'student_registration_number': $('#student_registration_number').val(),
//     //                     'grade': $('#grade').val(),
//     //                     'exam_year': $('#exam_year').val(),
//     //                     'publish': $('#publish').val(),
//     //                     'subject_code': $('#subject_code').val(),
//     //                     'subject_title': $('#subject_title').val(),
//     //                 },
//     //             }); 

//     //             alert('out');

//     //         },
//     // });


// });


// Default confirm box of JavaScript
$('form').submit(function() {
    var value = confirm("Are you sure?");
    return value; 
});


</script>


@endsection