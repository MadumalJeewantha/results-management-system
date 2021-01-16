@extends('layouts.dashboard')

@section('content')

<script>

    $(document).ready(function () {

        //enable tooltips which having data-toggle="tooltip
        $('[data-toggle="tooltip"]').tooltip();

        //add new row to table
        $(document).on('click', '.add', function () {
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" name="name[]" placeholder="Course Name" class="form-control" required/></td>';
            html += '<td><input type="text" name="description[]" placeholder="Description" class="form-control" /></td>';

            //delete button
            html += '<td><button type="button" name="remove" data-toggle="tooltip" title="Delete Course" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
            $('#item_table').append(html);
        });


        //remove row from table
        $(document).on('click', '.remove', function () {
            $(this).closest('tr').remove();
        });

        //submit event for validation
        //$('#add_course').on('submit', function (event) {
        //event.preventDefault();
        //});

    });
</script>

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add New Course <a href="/courses" class="btn btn-default pull-right">Back</a>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-education"></i>  <a href="/courses">Courses</a>
                    </li>
                    <li class="active">
                        <i class="glyphicon glyphicon-file"></i> Add New
                    </li>
                </ol>
            </div>
        </div>





        {!! Form::open(['action' => 'CoursesController@store', 'method'=>'POST' , 'class' => 'form-horizontal']) !!}

        {{-- For redirection purpose --}}
        <input type="hidden" id="from" name="from" value="">

        <div class="table-repsonsive">

            <table class="table table-bordered" id="item_table">
                <tr>
                    <th>Course Name</th>
                    <th>Description</th>

                    <!--add button-->
                    <th>
                        <button type="button" data-toggle="tooltip" data-delay='{ "show": 500, "hide": 100 }' title="Add New Course" name="add" class="btn btn-success btn-sm add">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </th>
                </tr>

                <tr>
                    <td><input type="text" name="name[]" placeholder="Course Name" class="form-control" required/></td>
                    <td><input type="text" name="description[]" placeholder="Description" class="form-control" /></td>

                    <!--delete button-->
                    <td>
                        <button disabled  type="button" data-toggle="tooltip" title="At least you need one Course" name="remove" class="btn btn-danger btn-sm remove">
                            <span class="glyphicon glyphicon-minus">                                
                            </span>
                        </button>
                    </td>
                </tr>

                </tr>
            </table>
            <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 10px">Save</button>                

        </div>
        {!! Form::close() !!}     

@endsection     