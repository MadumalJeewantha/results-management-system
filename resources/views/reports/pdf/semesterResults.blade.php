@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Semester Results</h1>
    <h4>Course : <strong>{{$course}}</strong></h4>
    <h4>Exam Year : <strong>{{$exam_year}}</strong></h4>
    <h4>Year : <strong>{{($year == '1' ? 'One' : ($year == '2' ? 'Two' : ($year == '3' ? 'Three' : ($year == '4' ? 'Four' : ''))))}}</strong></h4>
    <h4>Semester : <strong>{{($semester == '1' ? 'One' : ($semester == '2' ? 'Two' : ''))}}</strong></h4>
    

    {{-- return $grades[0][0][0]['id']; --}}

    <div class="col-lg-12">
            @if(count($grades)> 0)
                <table class="table table-striped table-bordered table-hover" id="lectures">
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Index No.</th>                                                       
                            <th>Name</th>   
                            @for($i = 0; count($subjects) > $i ; $i++)                                                  
                                <th>{{ $subjects[$i]['subject_code'] }}</th>   
                            @endfor                                                   

                        </tr>                            
                    </thead>

                    <tbody>  
                        @for($i = 0; count($grades) > $i; $i++)                  
                            <tr>
                                <td>{{$grades[$i][0][0]['student_registration_number']}}</td>
                                <td>{{$grades[$i][0][0]['student_index_number']}}</td>
                                <td>{{App\Student::find($grades[$i][0][0]['student_registration_number'])->initials}}&nbsp;{{App\Student::find($grades[$i][0][0]['student_registration_number'])->first_name}}&nbsp;{{App\Student::find($grades[$i][0][0]['student_registration_number'])->last_name}}</td>
                                
                                @for($j = 0; count($subjects) > $j ; $j++)
                                    <td>{{App\Grading::where('id','=', $grades[$i][$j][0]['grade'])->first()->grade}}</td>   
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>         
            @else
                <p class="alert alert-warning">You don't have any result yet.</p>
            @endif

                
    </div>
@endsection