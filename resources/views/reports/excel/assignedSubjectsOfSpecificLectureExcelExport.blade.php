
<table class="table table-striped table-bordered table-hover" id="lectures">
    <thead>
        <tr>
            <th>Subject Code</th>
            <th>Title</th>
            <th>Credits</th>
            <th>Status</th>
            <th>Conducted By</th>
        </tr>                            
    </thead>

    <tbody>  
        @foreach($subjects as $subject)                    
                <tr>
                    <td>{{$subject->subject_code}}</td>
                    <td>{{$subject->title}}</td>
                    <td>{{$subject->credits}}</td>
                    <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                    <td>{{App\Department::find($subject->department_id)->name}} Department</td>                                                                      
                </tr>
        @endforeach
    </tbody>
</table>