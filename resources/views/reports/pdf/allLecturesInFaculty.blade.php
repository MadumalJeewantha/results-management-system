@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Lecturers Details</h1>

    <div class="col-lg-12">
            @if(count($lectures)> 0)
                <table class="table table-striped table-bordered table-hover" id="lectures">
                    <thead>
                        <tr>
                            @for($i = 0; count($columns) > $i ; $i++)                                

                                @switch($columns[$i])

                                    @case('employee_id')
                                        <th>Employee ID</th>
                                        @break

                                    @case('department_id')
                                        <th>Department.</th>
                                        @break

                                    @case('initials')
                                        <th>Initials</th>
                                        @break

                                    @case('first_name')
                                        <th>First Name</th>
                                        @break

                                    @case('last_name')
                                        <th>Last Name</th>
                                        @break

                                    @case('email')
                                        <th>Email</th>
                                        @break

                                    @case('mobile')
                                        <th>Mobile</th>
                                        @break
                                        
                                    @case('gender')
                                        <th>Gender</th>
                                        @break
                                    
                                     @case('qualifications')
                                        <th>Qualifications</th>
                                        @break

                                    @case('profile_picture')
                                        <th>Profile Picture</th>
                                        @break

                                    @case('Bio')
                                        <th>Bio</th>
                                        @break                                    

                                @endswitch

                            @endfor                                                       
                        </tr>                            
                    </thead>

                    <tbody>  
                        @foreach($lectures as $lecture)                    
                                <tr>
                                    @for($i = 0; count($columns) > $i ; $i++)                                        
                                        
                                        @switch($columns[$i])

                                        @case('employee_id')
                                            <td>{{$lecture->employee_id}}</td>
                                            @break

                                        @case('department_id')
                                            <td>{{$lecture->department->name}}</td>
                                            @break

                                        @case('initials')
                                            <td>{{$lecture->initials}}</td>
                                            @break

                                        @case('first_name')
                                            <td>{{$lecture->first_name}}</td>
                                            @break

                                        @case('last_name')
                                            <td>{{$lecture->last_name}}</td>
                                            @break

                                        @case('email')
                                            <td>{{$lecture->email}}</td>
                                            @break

                                        @case('mobile')
                                            <td>{{$lecture->mobile}}</td>
                                            @break
                                            
                                        @case('gender')
                                            <td>{{$lecture->gender}}</td>
                                            @break
                                        
                                        @case('qualifications')
                                            <td>{{$lecture->qualifications}}</td>
                                            @break                                        
                                        
                                        @case('profile_picture')
                                            <td><img src="{{public_path().$lecture->profile_picture}}" style="height:255px;width:255px"></td>
                                            @break
                                        
                                        @case('bio')
                                            <td>{{$lecture->bio}}</td>
                                            @break

                                        @endswitch
                                    @endfor
                                                                      
                                </tr>
                        @endforeach
                    </tbody>
                </table>         
            @else
                <p class="alert alert-warning">You don't have any lecturer yet.</p>
            @endif

                
    </div>
@endsection