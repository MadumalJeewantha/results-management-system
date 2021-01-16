@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Results Sheet</h1>

    <div class="col-lg-12">
        <div class="jumbotron">

                <img src="{{public_path().$student->profile_picture}}" class="img-fluid img-thumbnail p-3" alt="Profile Picture" style="float:right;height:225px;weight:225px;">                            

                <h4>Student Name: <strong>{{$student->initials}}&nbsp;{{$student->first_name}}&nbsp;{{$student->last_name}}</strong></h4> 
                <h4>Registration Number: <strong>{{$student->student_registration_number}}</strong></h4> 
                <h4>Index Number: <strong>{{$student->student_index_number}}</strong></h4> 
                <h4>Academic Year: <strong>{{$student->academicYear->year}}</strong></h4>
                <h4>Course: <strong>{{$student->course->name}}</strong></h4>
                <h4>Specialized Area: <strong>{{$student->specializedArea->name}}</strong></h4>
                <h4>Department: <strong>{{$student->department->name}}</strong></h4>
                <span class="list-group-item {{($GPA < 2.0 ) ? 'list-group-item-danger' : ($GPA < 3.0  ? 'list-group-item-warning' : ($GPA >= 3.0  ? 'list-group-item-success' : ''))}}" style="width:200px">Current State of GPA : {{$GPA}}</span> 
                

        </div>

        {{-- Panel 1 --}}
                        {{-- Year 1 - Semester 1 --}}
                        <div class="row">
                                <div class="col-md-12">
                                    @if(count($year1_sem1)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 1 - Semester 1</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year1_sem1 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 1 --}}
    
                            {{-- Panel 2 --}}
                            {{-- Year 1 - Semester 2 --}}
                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($year1_sem2)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 1 - Semester 2</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year1_sem2 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 2 --}}
    
                            {{-- Panel 3 --}}
                            {{-- Year 2 - Semester 1 --}}
                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($year2_sem1)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 2 - Semester 1</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year2_sem1 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 3 --}}
    
                            {{-- Panel 4 --}}
                            {{-- Year 2 - Semester 2 --}}
                            <div class="row">
                                <div class="col-md-12">
                                        @if(count($year2_sem2)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 2 - Semester 2</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year2_sem2 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 4 --}}
    
                            {{-- Panel 5 --}}
                            {{-- Year 3 - Semester 1 --}}
                            <div class="row">
                                <div class="col-md-12">
                                        @if(count($year3_sem1)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 3 - Semester 1</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year3_sem1 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 5 --}}
    
                            {{-- Panel 6 --}}
                            {{-- Year 3 - Semester 2 --}}
                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($year3_sem2)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 3 - Semester 2</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year3_sem2 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 6 --}}
    
                            {{-- Panel 7 --}}
                            {{-- Year 4 - Semester 1 --}}
                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($year4_sem1)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 4 - Semester 1</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year4_sem1 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 7 --}}
    
                            {{-- Panel 8 --}}
                            {{-- Year 4 - Semester 2 --}}
                            <div class="row">
                                <div class="col-md-12">
                                    @if(count($year4_sem2)>0)
                                        <div class="panel panel-default">
                                                <div class="panel-heading">Year 4 - Semester 2</div>                    
    
                                                <div class="panel-body">                                                
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Exam Year</th>
                                                                <th>Grade</th>                                                                    
                                                            </tr>                            
                                                        </thead>
                                    
                                                        <tbody>  
                                                            @foreach($year4_sem2 as $subject)
                                                                <tr class="{{($subject->points_value < 2.0 ) ? 'danger' : 'success'}}">
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{App\Subject::find($subject->subject_code)->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{$subject->exam_year}}</td>
                                                                    <td>{{App\Grading::find($subject->grade)->grade}}</td>
                                                                </tr>                                            
                                                            @endforeach 
                                                        </tbody>
                                                    </table>                                                  
                                                </div>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            {{-- End panel 8 --}}
    
                            
                        </div>
                        {{-- End left panels --}}
                
    </div>
@endsection