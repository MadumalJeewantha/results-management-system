@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {
        $('#lectures').DataTable();
    } );
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
                    Lecturer - Subjects Enrollment    <a href="/settings" class="btn btn-default pull-right">Back</a>          
            </h1>
            
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
                        <i class="glyphicon glyphicon-eye-open"></i> Show Lecturers
                    </li>                     
            </ol>

        </div>

        <div class="col-lg-12">
                @if(count($lectures)> 0)
                    <table class="table table-striped table-bordered table-hover" id="lectures">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Department</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>

                                {{-- Action buttons --}}
                                {{-- Should use auth logics to show buttons --}}
                                <th>Actions</th>                                    
                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($lectures as $lecture)                    
                                    <tr class="item{{$lecture->employee_id}}">

                                        <td>{{$lecture->employee_id}}</td>
                                        <td>{{$lecture->department->name}}</td>
                                        <td>{{$lecture->first_name}}</td>
                                        <td>{{$lecture->last_name}}</td>
                                        <td>{{$lecture->email}}</td>
                                        <td>{{$lecture->mobile}}</td>

                                        {{-- Action buttons --}}
                                        <td>
                                                {{-- View button --}}
                                                <a href="lecture_subjects/{{$lecture->employee_id}}" class="btn btn-default btn-sm">View</a> 
                                                {{-- Add new lecture button --}}
                                                <a href="lecture_subjects/{{$lecture->employee_id}}/edit" class="btn btn-success btn-sm">Add New Subject</a>                                                                                      
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>         
                @else
                    <p class="alert alert-warning">You don't have any lecture yet.</p>
                @endif

                    
        </div>


</div>
{{-- end row --}}

     
@endsection