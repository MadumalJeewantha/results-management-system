@extends('layouts.dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
               View Results 
               <a href="{{(Auth::user()->type == 'student') ? '/dashboard' : '/grades'}}" class="btn btn-default pull-right">Back</a>

               {!! Form::open(['action' =>'ReportsController@fullResultsOfSpecificStudent' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}        
                    <input type="hidden" id="student_registration_number" name="student_registration_number" value="{{$student->student_registration_number}}">
                    <input type="hidden" id ="export_type" value="pdf" name = "export_type">
                    
                    <input type="submit" value="Download" class="btn btn-success" style="margin:5px">
                {!! Form::close() !!}

            </h1>
            <div class="jumbotron">

                    <img src="{{$student->profile_picture}}" class="img-fluid img-thumbnail p-3" alt="Profile Picture" style="float:right;height:225px;weight:225px;">                            

                    <h4>Student Name: <strong>{{$student->initials}}&nbsp;{{$student->first_name}}&nbsp;{{$student->last_name}}</strong></h4> 
                    <h4>Registration Number: <strong>{{$student->student_registration_number}}</strong></h4> 
                    <h4>Index Number: <strong>{{$student->student_index_number}}</strong></h4> 
                    <h4>Academic Year: <strong>{{$student->academicYear->year}}</strong></h4>
                    <h4>Course: <strong>{{$student->course->name}}</strong></h4>
                    <h4>Specialized Area: <strong>{{$student->specializedArea->name}}</strong></h4>
                    <h4>Department: <strong>{{$student->department->name}}</strong></h4>

            </div>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-text-background"></i> Results
                    </li>    
                    <li class="active">
                        <i class="glyphicon glyphicon-eye-open"></i> {{$student->student_registration_number}}
                    </li>                 
                </ol>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    {{-- left side - 8 panels --}}
                    <div class="col-md-9" id="content">

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

                    {{-- Right side - 3 panels --}}
                    <div class="col-md-3">

                        {{-- Panel 1 --}}
                        {{-- GPA --}}
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">GPA</div>                    

                                    <div class="panel-body">                                                
                                        <div class="list-group">
                                            <span class="list-group-item">First Class                    : <strong>3.70</strong></span> 
                                            <span class="list-group-item">Second Class(Upper Division)   : <strong>3.30</strong></span> 
                                            <span class="list-group-item">Second Class(Lower Division)   : <strong>3.00</strong></span> 
                                            {{-- Current state --}}
                                            <span class="list-group-item {{($GPA < 2.0 ) ? 'list-group-item-danger' : ($GPA < 3.0  ? 'list-group-item-warning' : ($GPA >= 3.0  ? 'list-group-item-success' : ''))}}">Current State : {{$GPA}}</span> 
                                        </div>                                                    
                                    </div>
                                </div> 

                            </div>
                        </div>
                        {{-- End panel 1 --}}

                        {{-- Panel 2 --}}
                        {{-- Attentions --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Attention</div>                    

                                    <div class="panel-body">                                                
                                        <div class="list-group">
                                            {{-- if $GPA < 2.0 --> You are not qualified to have a degree --}}
                                            @if($GPA < 2.0)
                                                <span class="list-group-item list-group-item-danger"> You are not qualified to have a degree. Because your GPA is less than 2.0
                                                </span> 
                                            @endif
                                        </div>                                                    
                                    </div>
                                </div> 
                            </div>
                        </div>
                        {{-- End panel 2 --}}

                        {{-- Panel 3 --}}
                        {{-- Grading System --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Grading System</div>                    

                                    <div class="panel-body">                                                
                                        <div class="list-group">
                                            <span class="list-group-item list-group-item-info">
                                                <span>Grade</span>
                                                <span class="pull-right">Points</span>
                                            </span> 

                                            @foreach($gradings as $grading)
                                                <span class="list-group-item">
                                                    <span>{{$grading->grade}}</span>
                                                    <span class="pull-right"><strong>{{$grading->points}}</strong></span>                                                  
                                                </span> 
                                            @endforeach

                                        </div>                                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End panel 3 --}}

                    </div>{{-- End right panels --}}                    

                </div> {{-- end main row --}}
            </div>
        </div>



</div>
{{-- end row --}}
    
@endsection