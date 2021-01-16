@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Student Details - Assigned Subjects</h1>

    <div class="jumbotron">
        <h4>Student Registration Number: <strong>{{$student->student_registration_number}}</strong></h4>
        <h4>Name: <strong>{{$student->initials}}&nbsp;{{$student->first_name}}&nbsp;{{$student->last_name}}</strong></h4>
        <h4>Course: <strong>{{$student->course->name}}</strong></h4>
        <h4>Academic Year: <strong>{{$student->academicYear->year}}</strong></h4>
        <h4>Specialized Area: <strong>{{$student->specializedArea->name}}</strong></h4>
        <h4>Department: <strong>{{$student->department->name}}</strong></h4>
    </div>


    <div class="col-lg-12">

        {{-- Year 1 Semester 1 --}}
        <h4>Year 1 - Semester 1</h4>                    
        <table class="table table-striped table-bordered table-hover">
            
                <tr>
                    <th>Subject Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Conducted By</th>
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '1' && $subject->semester == '1')
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                    
                                    @endif
                                @endforeach
                                                               
                            </td> 

                        </tr>
                        @endif
                @endforeach                                 
        </table>
        {{-- End Year 1 Semester 1 --}}


        {{-- Year 1 Semester 2 --}}
        <h4>Year 1 - Semester 2</h4>                    
        <table class="table table-striped table-bordered table-hover">
            
                <tr>
                    <th>Subject Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Conducted By</th>
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '1' && $subject->semester == '2')
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                   
                                    @endif
                                @endforeach
                                                               
                            </td> 

                        </tr>
                        @endif
                @endforeach                                 
        </table>
        {{-- End Year 1 Semester 2 --}}


        {{-- Year 2 Semester 1 --}}
        <h4>Year 2 - Semester 1</h4>                    
        <table class="table table-striped table-bordered table-hover">
            
                <tr>
                    <th>Subject Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Conducted By</th>
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '2' && $subject->semester == '1')
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                    
                                    @endif
                                @endforeach
                                                               
                            </td> 

                        </tr>
                        @endif
                @endforeach                                 
        </table>
        {{-- End Year 2 Semester 1 --}}


        {{-- Year 2 Semester 2 --}}
        <h4>Year 2 - Semester 2</h4>                    
        <table class="table table-striped table-bordered table-hover">
            
                <tr>
                    <th>Subject Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Conducted By</th>
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '2' && $subject->semester == '2')
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                     
                                    @endif
                                @endforeach
                                                               
                            </td> 

                        </tr>
                        @endif
                @endforeach                                 
        </table>
        {{-- End Year 2 Semester 2 --}}

        {{-- Year 3 Semester 1 --}}
        <h4>Year 3 - Semester 1</h4>                    
        <table class="table table-striped table-bordered table-hover">
            
                <tr>
                    <th>Subject Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Conducted By</th>
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '3' && $subject->semester == '1' && ($subject->specialized_area_id == $student->specialized_area_id || $subject->specialized_area_id == $common_subjects_id))
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                  
                                    @endif
                                @endforeach
                                                               
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
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '3' && $subject->semester == '2' && ($subject->specialized_area_id == $student->specialized_area_id || $subject->specialized_area_id == $common_subjects_id))
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                    
                                    @endif
                                @endforeach
                                                               
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
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '4' && $subject->semester == '1' && ($subject->specialized_area_id == $student->specialized_area_id || $subject->specialized_area_id == $common_subjects_id))
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                    
                                    @endif
                                @endforeach
                                                               
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
                    <th>Status</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '4' && $subject->semester == '2' && ($subject->specialized_area_id == $student->specialized_area_id || $subject->specialized_area_id == $common_subjects_id))
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>

                            <td>                                                    
                               
                                @foreach($studentSubjects as $studentSubject) 
                                    {{-- Find whether subjects are matched --}}
                                    @if($studentSubject->subjects_subject_code == $subject->subject_code) 
                                        Enrolled                                                                                                                                                                                                                
                                    @endif
                                @endforeach
                                                               
                            </td> 

                        </tr>
                        @endif
                @endforeach                                 
        </table>
        {{-- End Year 4 Semester 2 --}}






    </div>

@endsection