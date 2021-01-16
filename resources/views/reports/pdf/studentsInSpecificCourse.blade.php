@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Student Details</h1>
    <h4>Academic Year : <strong>{{$academicYear}}</strong></h4>
    <h4>Course : <strong>{{$course}}</strong></h4>

    <div class="col-lg-12">
            @if(count($students)> 0)
                <table class="table table-striped table-bordered table-hover" id="students">
                    <thead>
                        <tr>
                            @for($i = 0; count($columns) > $i ; $i++)                                

                                @switch($columns[$i])

                                    @case('student_registration_number')
                                        <th>Registration No.</th>
                                        @break

                                    @case('student_index_number')
                                        <th>Index No.</th>
                                        @break

                                    @case('department_id')
                                        <th>Department</th>
                                        @break

                                    @case('course_id')
                                        <th>Course</th>
                                        @break

                                    @case('academic_year_id')
                                        <th>Academic Year</th>
                                        @break

                                    @case('specialized_area_id')
                                        <th>Specialized Area</th>
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

                                    @case('nic_number')
                                        <th>NIC No.</th>
                                        @break

                                    @case('date_of_birth')
                                        <th>Date of Birth</th>
                                        @break

                                    @case('gender')
                                        <th>Gender</th>
                                        @break
                                        
                                    @case('marriage_state')
                                        <th>Marriage State</th>
                                        @break

                                    @case('email')
                                        <th>Email</th>
                                        @break

                                    @case('contact_no_mobile')
                                        <th>Mobile</th>
                                        @break
                                        
                                    @case('contact_no_home')
                                        <th>Home</th>
                                        @break
                                    
                                     @case('home_address_1')
                                        <th>Home Address 1</th>
                                        @break

                                    @case('home_address_2')
                                        <th>Home Address 2</th>
                                        @break

                                    @case('home_address_3')
                                        <th>Home Address 3</th>
                                        @break

                                    @case('current_address_1')
                                        <th>Current Address 1</th>
                                        @break
                                        
                                    @case('current_address_2')
                                        <th>Current Address 2</th>
                                        @break

                                    @case('current_address_1')
                                        <th>Current Address 3</th>
                                        @break

                                    @case('fb_url')
                                        <th>FB Profile</th>
                                        @break
                                        
                                    @case('linkedin_url')
                                        <th>Linkedin Profile</th>
                                        @break

                                    @case('father_name')
                                        <th>Father Name</th>
                                        @break

                                    @case('father_occupation')
                                        <th>Father Occupation</th>
                                        @break
                                    
                                    @case('mother_name')
                                        <th>Mother Name</th>
                                        @break

                                    @case('mother_occupation')
                                        <th>Mother Occupation</th>
                                        @break

                                    @case('number_of_sisters_and_brothers')
                                        <th>Sisters & Brothers</th>
                                        @break
                                    
                                    @case('dissertation_title')
                                        <th>Dissertation Title</th>
                                        @break
                                    
                                    @case('dissertation_published_link')
                                        <th>Dissertation Published Link</th>
                                        @break
                                    
                                    @case('supervisor_name')
                                        <th>Supervisor Name</th>
                                        @break
                                    
                                    @case('profile_picture')
                                        <th>Profile Picture</th>
                                        @break
                                    
                                    @case('bio')
                                        <th>Bio</th>
                                        @break

                                @endswitch

                            @endfor                                                       
                        </tr>                            
                    </thead>

                    <tbody>  
                        @foreach($students as $student)                    
                                <tr>
                                    @for($i = 0; count($columns) > $i ; $i++)                                        
                                        
                                        @switch($columns[$i])

                                        @case('student_registration_number')
                                            <td>{{$student->student_registration_number}}</td>
                                            @break

                                        @case('student_index_number')
                                            <td>{{$student->student_index_number}}</td>
                                            @break

                                        @case('department_id')
                                            <td>{{$student->department->name}}</td>
                                            @break

                                        @case('course_id')
                                            <td>{{$student->course->name}}</td>
                                            @break

                                        @case('academic_year_id')
                                            <td>{{$student->academicyear->year}}</td>
                                            @break

                                        @case('specialized_area_id')
                                            <td>{{$student->specializedArea->name}}</td>
                                            @break

                                        @case('initials')
                                            <td>{{$student->initials}}</td>
                                            @break
                                            
                                        @case('first_name')
                                            <td>{{$student->first_name}}</td>
                                            @break
                                        
                                        @case('last_name')
                                            <td>{{$student->last_name}}</td>
                                            @break

                                        @case('nic_number')
                                            <td>{{$student->nic_number}}</td>
                                            @break

                                        @case('date_of_birth')
                                            <td>{{$student->date_of_birth}}</td>
                                            @break

                                        @case('gender')
                                            <td>{{$student->gender}}</td>
                                            @break
                                            
                                        @case('marriage_state')
                                            <td>{{$student->marriage_state}}</td>
                                            @break

                                        @case('email')
                                            <td>{{$student->email}}</td>
                                            @break

                                        @case('contact_no_mobile')
                                            <td>{{$student->contact_no_mobile}}</td>
                                            @break
                                            
                                        @case('contact_no_home')
                                            <td>{{$student->contact_no_home}}</td>
                                            @break
                                        
                                        @case('home_address_1')
                                            <td>{{$student->home_address_1}}</td>
                                            @break

                                        @case('home_address_2')
                                            <td>{{$student->home_address_2}}</td>
                                            @break

                                        @case('home_address_3')
                                            <td>{{$student->home_address_3}}</td>
                                            @break

                                        @case('current_address_1')
                                            <td>{{$student->current_address_1}}</td>
                                            @break
                                            
                                        @case('current_address_2')
                                            <td>{{$student->current_address_2}}</td>
                                            @break

                                        @case('current_address_1')
                                            <td>{{$student->current_address_1}}</td>
                                            @break

                                        @case('fb_url')
                                            <td>{{$student->fb_url}}</td>
                                            @break
                                            
                                        @case('linkedin_url')
                                            <td>{{$student->linkedin_url}}</td>
                                            @break

                                        @case('father_name')
                                            <td>{{$student->father_name}}</td>
                                            @break

                                        @case('father_occupation')
                                            <td>{{$student->father_occupation}}
                                        
                                        @case('mother_name')
                                            <td>{{$student->mother_name}}</td>
                                            @break

                                        @case('mother_occupation')
                                            <td>{{$student->mother_occupation}}</td>
                                            @break

                                        @case('number_of_sisters_and_brothers')
                                            <td>{{$student->number_of_sisters_and_brothers}}</td>
                                            @break
                                        
                                        @case('dissertation_title')
                                            <td>{{$student->dissertation_title}}</td>
                                            @break
                                        
                                        @case('dissertation_published_link')
                                            <td>{{$student->dissertation_published_link}}</td>
                                            @break
                                        
                                        @case('supervisor_name')
                                            <td>{{$student->supervisor_name}}</td>
                                            @break
                                        
                                        @case('profile_picture')
                                            <td><img src="{{public_path() . $student->profile_picture}}" style="height:255px;width:255px"></td>
                                            @break
                                        
                                        @case('bio')
                                            <td>{{$student->bio}}</td>
                                            @break

                                        @endswitch
                                    @endfor
                                                                      
                                </tr>
                        @endforeach
                    </tbody>
                </table>         
            @else
                <p class="alert alert-warning">You don't have any student yet.</p>
            @endif

                
    </div>
@endsection