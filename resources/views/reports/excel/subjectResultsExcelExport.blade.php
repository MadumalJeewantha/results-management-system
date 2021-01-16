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