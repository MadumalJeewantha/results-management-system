@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {
        $('#students').DataTable( {
        dom: 'Blfrtip',
        buttons: [
       {
           extend: 'pdf',
           footer: true,
           title: 'Search Results - Results Management System | FMSC',
           pageSize: 'A4',
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            }
       },
       {
           extend: 'csv',
           footer: false,
           title: 'Search Results - Results Management System | FMSC',
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            }
          
       },
       {
           extend: 'excel',
           footer: false,
           title: 'Search Results - Results Management System | FMSC',
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            }
       },
       {
           extend: 'copy',
           footer: false,
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            }
       },
       {
           extend: 'print',
           footer: true,
           title: 'Search Results - Results Management System | FMSC',
           exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8]
            }
       }            
    ]  
    } );



    } );
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
               Search Results - Students <a href="/grades" class="btn btn-default pull-right">Back</a>                       
            </h1>
            <h4>Showing Results For - <strong>{{$hint}}</strong></h4>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li>
                        <i class="glyphicon glyphicon-text-background"></i> Results
                    </li>    
                    <li class="active">
                            <i class="glyphicon glyphicon-search"></i> Search Results
                    </li>                 
                </ol>
        </div>

        <div class="col-lg-12">
                @if(count($students)> 0)
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
                             
                                <th>Grade</th>   
                                <th>Exam Year</th>   
                                
                                <th>Actions</th>

                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($students as $student)                    
                                    <tr class="item{{$student->student_registration_number}}">
                                        {{-- student_registration_number --}}
                                        <td>{{$student->student_registration_number}}</td>

                                        {{-- student_index_number --}}
                                        <td>{{$student->student_index_number}}</td>

                                        {{-- academic_year_id --}}
                                        <td>{{App\AcademicYear::find($student->academic_year_id)->year}}</td>
                                        {{-- <td>{{$student->academicyear->year}}</td>                                 --}}

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

                                        {{-- grade --}}
                                        <td>{{App\Grading::find($student->grade)->grade}}</td>

                                        {{-- Exam_year --}}
                                        <td>{{$student->exam_year}}</td>

                                        {{-- View full results --}}
                                        <td>
                                            <a href="/grades/{{$student->student_registration_number}}" class="btn btn-success btn-sm">View</a>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>         
                @else
                    <p class="alert alert-warning">No results found.</p>
                @endif

                    
        </div>


</div>
{{-- end row --}}
    
@endsection