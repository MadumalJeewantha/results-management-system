@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Subject Results</h1>
    <h4>Subject Code : <strong>{{$subject_code}}</strong></h4>
    <h4>Subject Title : <strong>{{$subject_title}}</strong></h4>
    <h4>Credits : <strong>{{$credits}}</strong></h4>
    <h4>Exam Year : <strong>{{$exam_year}}</strong></h4>


    <div class="col-lg-12">
            @if(count($grades)> 0)
                <table class="table table-striped table-bordered table-hover" id="lectures">
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Index No.</th>                                                       
                            <th>Name</th>                                                       
                            <th>Grade</th>                                                       

                        </tr>                            
                    </thead>

                    <tbody>  
                        @foreach($grades as $grade)                    
                                <tr>
                                    <td>{{$grade->student_registration_number}}</td>
                                    <td>{{$grade->student_index_number}}</td>
                                    <td>{{App\Student::find($grade->student_registration_number)->initials}}&nbsp;{{App\Student::find($grade->student_registration_number)->first_name}}&nbsp;{{App\Student::find($grade->student_registration_number)->last_name}}</td>
                                    <td>{{App\Grading::where('id','=', $grade->grade)->first()->grade}}</td>                                                                      
                                </tr>
                        @endforeach
                    </tbody>
                </table>         
            @else
                <p class="alert alert-warning">You don't have any result yet.</p>
            @endif

                
    </div>
@endsection