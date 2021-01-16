@extends('layouts.pdf')

@section('content')
<h1 style="text-align:center">Lecturer Details - Assigned Subjects</h1>
<div class="jumbotron">
    <h4>Employee ID: <strong>{{$lecture->employee_id}}</strong></h4>
    <h4>Name: <strong>{{$lecture->initials}}&nbsp;{{$lecture->first_name}}&nbsp;{{$lecture->last_name}}</strong></h4>
    <h4>Department: <strong>{{App\Department::find($lecture->department_id)->name}}</strong></h4>
    <h4>Mobile: <strong>{{$lecture->mobile}}</strong></h4>
    <h4>Email: <strong>{{$lecture->email}}</strong></h4>
</div>


    <div class="col-lg-12">
            @if(count($subjects)> 0)
                <table class="table table-striped table-bordered table-hover" id="lectures">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Title</th>
                            <th>Credits</th>
                            <th>Status</th>
                            <th>Conducted By</th>
                        </tr>                            
                    </thead>

                    <tbody>  
                        @foreach($subjects as $subject)                    
                                <tr>
                                    <td>{{$subject->subject_code}}</td>
                                    <td>{{$subject->title}}</td>
                                    <td>{{$subject->credits}}</td>
                                    <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                    <td>{{App\Department::find($subject->department_id)->name}} Department</td>                                                                      
                                </tr>
                        @endforeach
                    </tbody>
                </table>         
            @else
                <p class="alert alert-warning">You don't have subject yet.</p>
            @endif

                
    </div>
@endsection