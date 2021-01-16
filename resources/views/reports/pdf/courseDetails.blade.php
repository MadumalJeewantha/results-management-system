@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Course Details</h1>

    <h4>Course: <strong>{{$course_name}}</strong></h4>


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
                        </tr>
                        @endif
                @endforeach                                 
        </table>
        {{-- End Year 2 Semester 2 --}}


        {{-- Loop through specializations --}}

        @foreach($specializedAreas as $specializedArea)
        {{-- Year 3 Semester 1 --}}
        <h4><strong>{{($specializedArea->name == 'Not Specified') ? 'Common Subjects' : $specializedArea->name }}</strong></h4>
        <h4>Year 3 - Semester 1</h4>                    
        <table class="table table-striped table-bordered table-hover">
            
                <tr>
                    <th>Subject Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Conducted By</th>
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '3' && $subject->semester == '1' && $subject->specialized_area_id == $specializedArea->specialized_area_id)
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>                            
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
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '3' && $subject->semester == '2' && $subject->specialized_area_id == $specializedArea->specialized_area_id)
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>                            
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
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '4' && $subject->semester == '1' && $subject->specialized_area_id == $specializedArea->specialized_area_id)
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>                            
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
                </tr>

                {{-- Loop through all subjects --}}
                @foreach($subjects as $subject)
                        @if($subject->year == '4' && $subject->semester == '2' && $subject->specialized_area_id == $specializedArea->specialized_area_id)
                        <tr>    
                            <td>{{$subject->subject_code}}</td>
                            <td>{{$subject->title}}</td>
                            <td>{{$subject->credits}}</td>
                            <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                            <td>{{$subject->department->name}} Department</td>                            
                        </tr>
                        @endif
                @endforeach                                 
        </table>
        {{-- End Year 4 Semester 2 --}}

        @endforeach





    </div>

@endsection