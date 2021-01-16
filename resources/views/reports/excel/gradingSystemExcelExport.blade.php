<table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                    <th>Grade</th>
                    <th>Points</th>
            </tr>
        </thead>

        <tbody>  
                @foreach($gradings as $grading)                   
                        <tr>
                            <td>{{$grading->grade}}</td>
                            <td>{{$grading->points}}</td>
                        </tr>
                @endforeach
        </tbody>
</table>