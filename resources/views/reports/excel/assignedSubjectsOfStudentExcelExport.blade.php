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