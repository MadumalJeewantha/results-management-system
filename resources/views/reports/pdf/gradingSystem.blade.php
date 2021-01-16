@extends('layouts.pdf')

@section('content')
    <h1 style="text-align:center">Grading System</h1>
    
    <div class="col-md-12">
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
    </div>


@endsection