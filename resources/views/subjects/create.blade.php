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
            // course_id
            html +=  '<td>';
            html +=  '<select class="form-control" data-role="select" selected="selected" required="required" name="course_id[]">';
            html +=    '<?php foreach($courses as $course){ ?>';
            html +=     '<option value = "<?php echo($course->course_id) ?>" >'; 
            html +=           '<?php echo($course->name) ?>'; 
            html +=     '</option>';                         
            html +=     '<?php } ?>';
            html +=  '</select>';                
            html +=  '</td>';
            
            //subject_code
            html += '<td><input type="text" name="subject_code[]" placeholder="Subject Code" class="form-control" required/></td>';
            
            //title
            html +=  '<td><input type="text" name="title[]" placeholder="Course Title" class="form-control" required /></td>';

            //specialized_area_id
            html +=  '<td>';
            html +=  '<select class="form-control" data-role="select" selected="selected" required="required" name="specialized_area_id[]">';
            html +=    '<?php foreach($specializedAreas as $specializedArea){ ?>';
            html +=     '<option value = "<?php echo($specializedArea->specialized_area_id) ?>" >'; 
            html +=           '<?php echo($specializedArea->name) ?>'; 
            html +=     '</option>';                         
            html +=     '<?php } ?>';
            html +=  '</select>';                
            html +=  '</td>';

            //department_id
            html +=  '<td>';
            html +=  '<select class="form-control" data-role="select" selected="selected" required="required" name="department_id[]">';
            html +=    '<?php foreach($departments as $department){ ?>';
            html +=     '<option value = "<?php echo($department->department_id) ?>" >'; 
            html +=           '<?php echo($department->name) ?>'; 
            html +=     '</option>';                         
            html +=     '<?php } ?>';
            html +=  '</select>';                
            html +=  '</td>';

            //credits
            html +=  '<td><input type="text" name="credits[]" placeholder="Credits" class="form-control" required/></td>';

            //status
            html +=  '<td><select  class="form-control" data-role="select" selected="selected" name="status[]"><option value="1">Compulsory</option><option value="2">Optional</option> <option value="3">Major </option><option value="4">Electives</option></select></td>';
            //year
            html +=  '<td><select  class="form-control" data-role="select" selected="selected" name="year[]"><option value="1">One</option><option value="2">Two</option><option value="3">Three</option><option value="4">Four</option></select></td>';

            //semester
            html += '<td><select  class="form-control" data-role="select" selected="selected" name="semester[]"><option value="1">One</option><option value="2">Two</option></select></td>';
            
            //delete button
            html += '<td><button type="button" name="remove" data-toggle="tooltip" title="Delete Subject" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></td>';
            
            html += '/<tr>';
            $('#item_table').append(html);
        });


        //remove row from table
        $(document).on('click', '.remove', function () {
            $(this).closest('tr').remove();
        });

    });
</script>


        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add New Subject <a href="/subjects" class="btn btn-default pull-right">Back</a>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                    <li>
                        <i class="glyphicon glyphicon-list"></i>  <a href="/subjects">Subjects</a>
                    </li>
                    <li class="active">
                        <i class="glyphicon glyphicon-file"></i> Add New
                    </li>
                </ol>
            </div>
        </div>

    {!! Form::open(['action' => 'SubjectsController@store', 'method'=>'POST' , 'class' => 'form-horizontal' ]) !!}

    {{-- for redirection purpose --}}    
    <input type="hidden" id="from" name="from" value="">

    <div class="table-repsonsive" style="overflow-x:auto;">

        <table class="table table-bordered table-hover" id="item_table">
            <tr>
                <!--Headings here-->
                <th>Course</th>
                <th>Subject Code</th>
                <th>Title</th>
                <th>Specialized Area</th>
                <th>Conducted By</th>
                <th width = "10">Credits</th>
                <th>Status</th>
                <th>Year</th>
                <th>Semester</th>        
                <!--Add button-->
                <th>
                    <button type="button" data-toggle="tooltip" data-delay='{ "show": 500, "hide": 100 }' title="Add new Subject" name="add" class="btn btn-success btn-sm add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </th>
            </tr>

            <tr>
                <!--Rows here-->

                {{-- course_id --}}
                <td>
                    <select class="form-control" data-role="select" selected="selected" required="required" name="course_id[]">
                            @foreach($courses as $course)
                                <option value="{{$course->course_id}}">
                                    {{$course->name}}
                                </option>                            
                            @endforeach 
                    </select>
                </td>

                {{-- subject_code --}}
                <td><input type="text" name="subject_code[]" placeholder="Subject Code" class="form-control" required/></td>

                {{-- title --}}
                <td><input type="text" name="title[]" placeholder="Course Title" class="form-control" required /></td>

                {{-- specialized_area_id --}}
                <td>
                    <select class="form-control" data-role="select" selected="selected" name="specialized_area_id[]">
                                               
                            @foreach($specializedAreas as $specializedArea)
                                <option value="{{$specializedArea->specialized_area_id}}">
                                    {{$specializedArea->name}}
                                </option>                            
                            @endforeach 
                    </select>
                </td>

                {{-- department_id --}}
                <td>
                    <select  class="form-control" data-role="select" selected="selected" name="department_id[]">                                                
                            @foreach($departments as $department)
                                <option value="{{$department->department_id}}">
                                    {{$department->name}}
                                </option>                            
                            @endforeach 
                    </select>
                </td>

                {{-- credits --}}
                <td><input type="text" name="credits[]" placeholder="Credits" class="form-control" required/></td>

                {{-- status --}}
                <td>
                        <select  class="form-control" data-role="select" selected="selected" name="status[]">                                                
                                    <option value="1">
                                        Compulsory
                                    </option>
    
                                    <option value="2">
                                        Optional
                                    </option> 
    
                                    <option value="3">
                                        Major
                                    </option>
                                    
                                    <option value="4">
                                        Electives
                                    </option>                                                             
                        </select>
                </td>

                {{-- year --}}
                <td>
                    <select  class="form-control" data-role="select" selected="selected" name="year[]">                                                
                                <option value="1">
                                    One
                                </option>

                                <option value="2">
                                    Two
                                </option> 

                                <option value="3">
                                    Three
                                </option>
                                
                                <option value="4">
                                    Four
                                </option>                                                             
                    </select>
                </td>

                {{-- semester --}}
                <td>
                    <select  class="form-control" data-role="select" selected="selected" name="semester[]">                                                
                            <option value="1">
                                One
                            </option>

                            <option value="2">
                                Two
                            </option>                                                                                      
                    </select>
                </td>

                <!--Delete button-->
                <td>
                    <button disabled  type="button" data-toggle="tooltip" title="At least you need one Subject" name="remove" class="btn btn-danger btn-sm remove">
                        <span class="glyphicon glyphicon-minus">                                
                        </span>
                    </button>
                </td>
            </tr>

        </table>
        <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 10px">Save</button>                

    </div>
    {!! Form::close() !!}     



@endsection     