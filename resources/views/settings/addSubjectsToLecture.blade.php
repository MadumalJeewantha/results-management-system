@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {
        $('#subjects').DataTable();
    } );
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
                    Lecturers - Subjects Enrollment    <a href="/lecture_subjects" class="btn btn-default pull-right">Back</a>          
            </h1>
            <h4>Employee ID - <strong>{{$employee_id}}</strong></h4>
            <h4>Name - <strong>{{App\Lecture::find($employee_id)->first_name}}&nbsp;{{App\Lecture::find($employee_id)->last_name}}</strong></h4>
            <a href="/lecture_subjects/{{$employee_id}}" class="btn btn-success">View Enrolled Subjects</a>
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>

                    <li>
                        <i class="glyphicon glyphicon-cog"></i>  <a href="/settings"> Settings </a>
                    </li> 

                    <li>
                        <i class="glyphicon glyphicon-user"></i> Lecturers
                    </li> 

                    <li class="active">
                        <i class="glyphicon glyphicon-eye-open"></i> Show Subjects
                    </li>                     
            </ol>

        </div>

        <div class="col-lg-12">
                @if(count($subjects)> 0)
                
                    <table class="table table-striped table-bordered table-hover" id="subjects">
                        <thead>
                            <tr>
                                    <th>Subject Code</th>
                                    <th>Title</th>
                                    <th>Credits</th>
                                    <th>Status</th>
                                    <th>Conducted By</th>
                                    <th>Academic Year</th>
                                    <th>Actions</th>                                   
                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($subjects as $subject)                    
                                    <tr>

                                            <td>{{$subject->subject_code}}</td>
                                            <td>{{$subject->title}}</td>
                                            <td>{{$subject->credits}}</td>
                                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                            <td>{{$subject->department->name}} Department</td>

                                            {!! Form::open(['action' =>'Lecture_SubjectsController@store' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}

                                            <td>
                                                {{-- Show academic years --}}                                        
                                                <div class="form-group">
                                                        <div class="controls col-sm-13">
                                                            <select id="academic_year_id" class="form-control" data-role="select" required="required" selected="selected" name="academic_year_id">
                                                                @foreach($academicYears as $academicYear)
                                                                    <option value="{{$academicYear->academic_year_id}}">
                                                                        {{$academicYear->year}}
                                                                    </option>                                                
                                                                @endforeach                                                
                                                            </select>                                                            
                                                        </div>
                                                </div>
                                            
                                            </td>
                                        {{-- Action buttons --}}
                                            <td>

                                                    <input type="hidden" name="lectures_emp_id" id="lectures_emp_id" value="{{$employee_id}}">
                                                    <input type="hidden" name="subjects_subject_code" id="subjects_subject_code" value="{{$subject->subject_code}}">

                                                    <input type="submit" value="Add" class="btn btn-primary btn-sm" title="Enrolle this subject to {{App\Lecture::find($employee_id)->first_name}}">
                                            </td>
                                            {!! Form::close() !!} 

                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                            
                @else
                    <p class="alert alert-warning">You don't have any subject yet.</p>
                @endif

                    
        </div>


</div>
{{-- end row --}}

     
@endsection