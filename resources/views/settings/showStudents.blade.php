@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {
        $('#students').DataTable();
    } );
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">                                                                                                                                              
                Students - Specialization    <a href="/settings" class="btn btn-default pull-right">Back</a>
            </h1>
            <h3>
               Following <strong>{{Illuminate\Support\Facades\DB::table('courses')->where('course_id', $request->course_id)->first()->name}}</strong> in Academic Year <strong>{{Illuminate\Support\Facades\DB::table('academic_years')->where('academic_year_id', $request->academic_year_id)->first()->year}}</strong>              
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
                    <li class="active">
                        <i class="glyphicon glyphicon-eye-open"></i> Show Students
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
                                <th>Specialization</th>

                                {{-- Action buttons --}}
                                {{-- Should use auth logics to show buttons --}}
                                <th>Actions</th>                                    
                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($students as $student)                    
                                    <tr class="{{($student->specializedArea->name == 'Not Specified' )? 'danger' :'success' }}">
                                        <td>{{$student->student_registration_number}}</td>
                                        <td>{{$student->student_index_number}}</td>
                                        <td>{{$student->academicyear->year}}</td>
                                        <td>{{$student->first_name}}</td>
                                        <td>{{$student->last_name}}</td>
                                        <td>{{$student->course->name}}</td>
                                        <td>{{$student->department->name}}</td>
                                        <td>{{$student->specializedArea->name}}</td>


                                        {{-- Action buttons --}}
                                        <td>
                                        {!! Form::open(['action' => ['SettingsController@showSpecializationsSettingsPage',$student->student_registration_number ] , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
                                                {{-- View button --}}
                                                <input type="submit" class="btn btn-primary btn-sm" value="View">                                                         
                                                {{-- <a href="/settings/students/{{$student->student_registration_number}}" class="btn btn-primary btn-sm">View</a>           --}}
                                        {!! Form::close() !!}                                                                                     
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>         
                @else
                    <p class="alert alert-warning">You don't have any student yet.</p>
                @endif

                    
        </div>


</div>
{{-- end row --}}
   
@endsection