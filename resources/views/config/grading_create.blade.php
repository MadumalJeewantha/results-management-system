@extends('layouts.app')

@section('content')

<div class="alert alert-warning" style="margin-top:10px">
    Before using the Results Management System you have to do some configurations. This won't take long time.            
</div>

<script>
        $(document).ready(function () {
    
            //enable tooltips which having data-toggle="tooltip
            $('[data-toggle="tooltip"]').tooltip();
    
            //add new row to table
            $(document).on('click', '.add', function () {
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="grade[]" placeholder="Grade" class="form-control" required/></td>';
                html += '<td><input type="text" name="points[]" placeholder="Grade Points per Credit" class="form-control" /></td>';
    
                //delete button
                html += '<td><button type="button" name="remove" data-toggle="tooltip" title="Delete Grade" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                $('#item_table').append(html);
            });
    
    
            //remove row from table
            $(document).on('click', '.remove', function () {
                $(this).closest('tr').remove();
            });
    
        });
    </script>


<div class="jumbotron ">
    <h2><span class="glyphicon glyphicon-cog"></span> Configurations</h2>
    <hr>
    <h3><strong><span class="badge badge-primary badge-pill">8</span> Grading System creation</strong></h3>
    <p>There should be a well-defined grading system to evaluate student marks.</p>


    <div class="container">
            {!! Form::open(['action' => 'GradingsController@store', 'method'=>'POST' , 'class' => 'form-horizontal' ]) !!}

    {{-- for redirection purpose --}}
    <input type="hidden" id="from" name="from" value="config">

    <div class="table-repsonsive">

        <table class="table table-bordered" id="item_table">
            <tr>
                <!--add headings here-->
                <th>Grade</th>
                <th>Points</th>

                <!--add button-->
                <th>
                    <button type="button" data-toggle="tooltip" data-delay='{ "show": 500, "hide": 100 }' title="Add new Grade" name="add" class="btn btn-success btn-sm add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </th>
            </tr>

            <tr>
                <!--add rows here-->
                <td><input type="text" name="grade[]" placeholder="Grade" class="form-control" required/></td>
                <td><input type="text" name="points[]" placeholder="Grade Points per Credit" class="form-control" /></td>

                <!--delete button-->
                <td>
                    <button disabled  type="button" data-toggle="tooltip" title="At least you need one Grade" name="remove" class="btn btn-danger btn-sm remove">
                        <span class="glyphicon glyphicon-minus">                                
                        </span>
                    </button>
                </td>
            </tr>

        </table>
        <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 10px">Save</button>                

    </div>
    {!! Form::close() !!}     
        
    </div>

</div>
@endsection     