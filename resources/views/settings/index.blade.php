@extends('layouts.dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Settings
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-cog"></i> Settings
                    </li>                     
                </ol>
        </div>



        <div class="col-lg-12">

            {{-- Deans only --}}
                @if(Auth::user()->type == 'dean')
                <h3><span class="glyphicon glyphicon-cog"></span> General</h3>
                <div class="panel-group" id="accordion">

                {{-- Academic Years --}}
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                              Academic Years</a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p> There should be at least one academic year to add students to the system. Ex: 2014/2015</p>
                                    <a href="academic_years/create" class="btn btn-success pull-right" style="margin:5px">Add New Academic Year</a>
                                    @if(count($academicYears)> 0)
                                    <table class="table table-striped table-bordered table-hover" id="academicYears">
                                            <tr>
                                                <th>Year</th>
                                                <th>Description</th>
            
                                                {{-- Action buttons --}}
                                                <th width="150px">Actions</th>                                    
                                            </tr>
            
                                            @foreach($academicYears as $academicYear)                                                        
            
                                            <tr class="item{{$academicYear->academic_year_id}}-academicYears">
            
                                                    <td>{{$academicYear->year}}</td>
                                                    <td>{{$academicYear->description}}</td>
            
                                                    {{-- Action buttons --}}
                                                    <td>
                                                            {{-- Edit button --}}
                                                            <button type="button" style="margin-right:5px" class="edit-modal-academicYears btn btn-primary btn-sm" data-id="{{ $academicYear->academic_year_id }}" data-year="{{ $academicYear->year }}"  data-description="{{ $academicYear->description }}">
                                                            Edit
                                                            </button>
            
                                                            {{-- Delete button --}}
                                                            <button type="button" style="margin-right:5px" class="delete-modal-academicYears btn btn-danger btn-sm" data-id="{{ $academicYear->academic_year_id }}">
                                                            Delete
                                                            </button>                                                
                                                    </td>
                                            </tr>
                                            @endforeach
                                    </table>
                                    @else
                                    <p class="alert alert-warning">You don't have any Academic Year.</p>
                                    @endif
                            </div>
                          </div>
                        </div>

                        {{-- Grading system --}}
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                              Grading System</a>
                            </h4>
                          </div>
                          <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                    <p>There should be a well-defined grading system to evaluate student marks. This may include MC(Medical-Absent due to medical reason), DFR(Deferred-Absent due to valid reason) and AB(Absent-Absent without valid reason) symbols which are not consider for credit calculation.</p>
                                    <a href="gradings/create" class="btn btn-success pull-right" style="margin:5px">Add New Grade</a>
                                    @if(count($gradings)> 0)
                                    <table class="table table-striped table-bordered table-hover" id="gradings">
                                            <tr>
                                                <th>Grade</th>
                                                <th>Points</th>
            
                                                {{-- Action buttons --}}
                                                <th width="150px">Actions</th>                                    
                                            </tr>
            
                                            @foreach($gradings as $grading)  
                                            
                                            {{-- Skip default values --}}
                                            @if($grading->grade == 'AB' || $grading->grade == 'MC' || $grading->grade == 'DFR' )
                                                @continue
                                            @endif
            
                                            <tr class="item{{$grading->id}}-gradings">
            
                                                    <td>{{$grading->grade}}</td>
                                                    <td>{{$grading->points}}</td>
                                                                                                                    
                                                        {{-- Action buttons --}}
                                                        <td>
                                                                {{-- Edit button --}}
                                                                <button type="button" style="margin-right:5px" class="edit-modal-gradings btn btn-primary btn-sm" data-id="{{ $grading->id }}" data-grade="{{ $grading->grade }}"  data-points="{{ $grading->points }}">
                                                                Edit
                                                                </button>
                
                                                                {{-- Delete button --}}
                                                                <button type="button" style="margin-right:5px" class="delete-modal-gradings btn btn-danger btn-sm" data-id="{{ $grading->id }}">
                                                                Delete
                                                                </button>                                                
                                                        </td>
                                            </tr>
                                            @endforeach
                                    </table>
                                    @else
                                    <p class="alert alert-warning">You don't have any grade.</p>
                                    @endif
                            </div>
                          </div>
                        </div>

                        {{-- specializedAreas --}}
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                             Specialized Areas</a>
                            </h4>
                          </div>
                          <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                    <p></p>
                                    <a href="specialized_areas/create" class="btn btn-success pull-right" style="margin:5px">Add New Specialized Area</a>
                                    @if(count($specializedAreas)> 0)
                                    <table class="table table-striped table-bordered table-hover" id="specialized_areas">
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
            
                                                {{-- Action buttons --}}
                                                <th width="150px">Actions</th>                                    
                                            </tr>
            
                                            @foreach($specializedAreas as $specializedArea)    

                                                {{-- Skip showing 'Not Specified' specializedArea  --}}
                                                {{-- It keep as a default value --}}
                                                @if($specializedArea->name == 'Not Specified')
                                                    @continue
                                                @endif
                                    
                                            <tr class="item{{$specializedArea->specialized_area_id}}-specializedAreas">
            
                                                    <td>{{$specializedArea->name}}</td>
                                                    <td>{{$specializedArea->description}}</td>
            
                                                    {{-- Action buttons --}}
                                                    <td>
                                                            {{-- Edit button --}}
                                                            <button type="button" style="margin-right:5px" class="edit-modal-specializedAreas btn btn-primary btn-sm" data-id="{{ $specializedArea->specialized_area_id }}" data-name="{{ $specializedArea->name }}"  data-description="{{ $specializedArea->description }}">
                                                            Edit
                                                            </button>
            
                                                            {{-- Delete button --}}
                                                            <button type="button" style="margin-right:5px" class="delete-modal-specializedAreas btn btn-danger btn-sm" data-id="{{ $specializedArea->specialized_area_id }}">
                                                            Delete
                                                            </button>                                                
                                                    </td>
                                            </tr>
                                            @endforeach
                                    </table>
                                    @else
                                    <p class="alert alert-warning">You don't have any specialization.</p>
                                    @endif
                            </div>
                          </div>
                        </div>
                        @endif

                        <h3><span class="glyphicon glyphicon-education"></span> Students</h3>                        
                        {{-- Assign Specialization --}}
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                   Assign Specialization</a>
                                  </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                  <div class="panel-body">
                                        <p>Here you can do specializations for students. 
                                        It will include setup department, specialization area and its subjects.
                                        This process should have done by Dean or Head of the Department only.</p>

                                        <p>This may use Academic Year and Course to filter out students.</p><br>

                                        {{-- Show Departments and Course --}}
                                        <!--academic_year_id-->
                                        {!! Form::open(['action' =>'SettingsController@showStudentsSettingsPage' , 'method' => 'POST', 'class'=> 'form-horizontal']) !!}
                                        <div class="col-md-8">
                                            <div class="form-group{{ $errors->has('academic_year_id') ? ' has-error' : '' }}">
                                                    <label class="control-label control-label-left col-sm-3" for="academic_year_id">Academic Year<span class="req"> *</span></label>
                                                    <div class="controls col-sm-9">
                                                        <select id="academic_year_id" class="form-control" data-role="select" required="required" selected="selected" name="academic_year_id">
                                                            @foreach($academicYears as $academicYear)
                                                                <option value="{{$academicYear->academic_year_id}}">
                                                                    {{$academicYear->year}}
                                                                </option>                                                
                                                            @endforeach                                                
                                                        </select>                                                            
                                                    </div>
                                            </div>

                                            <!--course_id-->
                                            <div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
                                                <label class="control-label control-label-left col-sm-3" for="course_id">Course<span class="req"> *</span></label>
                                                <div class="controls col-sm-9">
                                                    <select id="course_id" class="form-control" data-role="select" selected="selected" required="required" name="course_id">
                                                        @foreach($courses as $course)
                                                            <option value="{{$course->course_id}}">
                                                                {{$course->name}}
                                                            </option>                                                
                                                        @endforeach 
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="submit" style="margin:5px" class="btn btn-success pull-right">View Students</button>


                                        </div>
                                        {!! Form::close() !!}
    

                                  </div>
                                </div>
                              </div>
                        {{-- End - Assign Specialization --}}


                        
                        <h3><span class="glyphicon glyphicon-user"></span> Lecturers</h3>                        
                        {{-- Assign Lectures to Subjects --}}
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                  <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                            Lecturers - Subjects Enrolment  </a>
                                  </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                  <div class="panel-body">
                                        <p>Here you can do enrolment for lecturers. 
                                        A lecturer can conduct one or more subjects and this may vary among academic years.
                                        This process should have done by Dean or Head of the Department only.</p>
                                        
                                        <a href="/lecture_subjects" class="btn btn-success pull-right">View Lecturers</a>

                                  </div>
                                </div>
                              </div>
                        {{-- End - Assign lectures to subjects --}}


                      </div> 
                      {{-- End - panel group --}}
                      

                        
        </div>

    </div>        



{{-- Academic years Modals--}}

        <!-- Delete Modal -->
        <div id="deleteModal-academicYears" class="modal fade" role="dialog">
                <div class="modal-dialog">
              
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="background-color:#bf5329;color:#fff">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Delete Confirmation</h4>
                    </div>
                    <div class="modal-body">
                      <p> Do you really want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger delete-academicYears" data-dismiss="modal">Delete</button>                        
                    </div>
                  </div>
              
                </div>
        </div>
        
        <!-- Edit Modal -->
         <div id="editModal-academicYears" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                      
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#3097d1;color:#fff">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title modalTitleEdit-academicYears">Edit Academic Year</h4>
                            </div>
                            <div class="modal-body">
                                        
                                        <form class="form-horizontal" role="form">                                               

                                             {{-- year --}}
                                             <div class="form-group">
                                                    <label class="control-label col-sm-2" for="year_edit-academicYears">Academic Year<span class="req"> *</span></label>
                                                    <div class="col-sm-10">
                                                      <input type="text" required class="form-control" id="year_edit-academicYears" placeholder="Academic Year">
                                                                                 
                                                      <span class="help-block errorYear-academicYears hidden" style="color:#a94442">                                                        
                                                      </span>
                                                  </div>
                                                  </div>

                                                {{-- description --}}
                                                <div class="form-group">
                                                  <label class="control-label col-sm-2" for="description_edit-academicYears">Description</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="description_edit-academicYears" placeholder="Description">
                                                                               
                                                    <span class="help-block errorDescription-academicYears hidden" style="color:#a94442">                                                        
                                                    </span>
                                                </div>
                                                </div>
                                               
                                        </form> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary update-academicYears" data-dismiss="modal">Update</button>                        
                            </div>
                          </div>
                      
                        </div>
                </div>
{{-- End Academic years - Modals --}}


{{-- Gradings System  --}}
    <!-- Delete Modal -->
    <div id="deleteModal-gradings" class="modal fade" role="dialog">
            <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color:#bf5329;color:#fff">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                <p> Do you really want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger delete-gradings" data-dismiss="modal">Delete</button>                        
                </div>
            </div>
        
            </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal-gradings" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#3097d1;color:#fff">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title modalTitleEdit-gradings">Edit Academic Year</h4>
                        </div>
                        <div class="modal-body">
                                    
                                    <form class="form-horizontal" role="form">                                               

                                        {{-- grade --}}
                                        <div class="form-group">
                                                <label class="control-label col-sm-2" for="grade_edit-gradings">Academic Year<span class="req"> *</span></label>
                                                <div class="col-sm-10">
                                                <input type="text" required class="form-control" id="grade_edit-gradings" placeholder="Grade">
                                                                            
                                                <span class="help-block errorGrade-gradings hidden" style="color:#a94442">                                                        
                                                </span>
                                            </div>
                                            </div>

                                            {{-- points --}}
                                            <div class="form-group">
                                            <label class="control-label col-sm-2" for="points_edit-gradings">Grade Points per Credit<span class="req"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="points_edit-gradings" placeholder="Points" required>
                                                                        
                                                <span class="help-block errorPoints-gradings hidden" style="color:#a94442">                                                        
                                                </span>
                                            </div>
                                            </div>
                                        
                                    </form> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary update-gradings" data-dismiss="modal">Update</button>                        
                        </div>
                    </div>
                
                    </div>
            </div>
{{-- Gradings System - Modals --}}


{{-- Specialized Areas Modals--}}

        <!-- Delete Modal -->
        <div id="deleteModal-specializedAreas" class="modal fade" role="dialog">
                <div class="modal-dialog">
              
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="background-color:#bf5329;color:#fff">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Delete Confirmation</h4>
                    </div>
                    <div class="modal-body">
                      <p> Do you really want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger delete-specializedAreas" data-dismiss="modal">Delete</button>                        
                    </div>
                  </div>
              
                </div>
        </div>
        
        <!-- Edit Modal -->
         <div id="editModal-specializedAreas" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                      
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#3097d1;color:#fff">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title modalTitleEdit-specializedAreas">Edit Specialized Area</h4>
                            </div>
                            <div class="modal-body">
                                        
                                        <form class="form-horizontal" role="form">                                               

                                             {{-- name --}}
                                             <div class="form-group">
                                                    <label class="control-label col-sm-2" for="name_edit-specializedAreas">Name<span class="req"> *</span></label>
                                                    <div class="col-sm-10">
                                                      <input type="text" required class="form-control" id="name_edit-specializedAreas" placeholder="Specialized Area">
                                                                                 
                                                      <span class="help-block errorName-specializedAreas hidden" style="color:#a94442">                                                        
                                                      </span>
                                                  </div>
                                                  </div>

                                                {{-- description --}}
                                                <div class="form-group">
                                                  <label class="control-label col-sm-2" for="description_edit-specializedAreas">Description</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="description_edit-specializedAreas" placeholder="Description">
                                                                               
                                                    <span class="help-block errorDescription-specializedAreas hidden" style="color:#a94442">                                                        
                                                    </span>
                                                </div>
                                                </div>
                                               
                                        </form> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary update-specializedAreas" data-dismiss="modal">Update</button>                        
                            </div>
                          </div>
                      
                        </div>
                </div>
{{-- End SpecializedAreas - Modals --}}


        
<script type="text/javascript">
// Academic years Scripts

    // delete function
    $(document).on('click', '.delete-modal-academicYears', function() {
                $('#deleteModal-academicYears').modal('show');
                id = $(this).data('id');
            });
            $('.modal-footer').on('click', '.delete-academicYears', function() {
                $.ajax({
                    type: 'DELETE',
                    url: 'academic_years/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(data) {
                    toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});

                    //Remove table row    
                        $('.item' + id + '-academicYears').remove();                    
                    }
                });
            });

    //Update function
    $(document).on('click', '.edit-modal-academicYears', function() {
                //Get academicYear for Title
                year = $(this).data('year');
                //Take id value
                id = $(this).data('id')

                //Set Modal title
                $('.modalTitleEdit-academicYears').text('Edit Academic Year: '+ year);

                //Fill values in modal            
                $('#description_edit-academicYears').val($(this).data('description'));
                $('#year_edit-academicYears').val($(this).data('year'));


                //Show modal
                $('#editModal-academicYears').modal('show');
            });
            $('.modal-footer').on('click', '.update-academicYears', function() {
                $.ajax({
                    type: 'PUT',
                    url: 'academic_years/' + id,
                    data: {
                        //Pass current values to backend
                        '_token': $('input[name=_token]').val(),
                        'academic_year_id': id,
                        'year': $('#year_edit-academicYears').val(),
                        'description': $('#description_edit-academicYears').val()
                    },

                    success: function(data) {

                        if ((data.errors)) {
                                
                            setTimeout(function () {
                                $('#editModal-academicYears').modal('show');
                                toastr.error('Validation error.', 'Whoops! Something went wrong,', {timeOut: 5000});
                            }, 500);


                            if (data.errors.year) {
                                $('.errorYear-academicYears').removeClass('hidden');
                                $('.errorYear-academicYears').text(data.errors.year);
                            }

                            if (data.errors.description) {
                                $('.errorDescription-academicYears').removeClass('hidden');
                                $('.errorDescription-academicYears').text(data.errors.description);
                            }


                        } else {
                            // clear error messages
                            $('.errorYear-academicYears').text('');
                            $('.errorDescription-academicYears').text('');


                            toastr.success('Successfully updated.', 'Success Alert', {timeOut: 5000});
                            row  =  "<tr class='item" + data.academic_year_id + "-academicYears'>";
                            row +=        "<td>" + data.year + "</td>";
                            row +=        "<td>" + data.description + "</td>";

                                    // Action buttons
                            row +=        "<td>";
                                    // Edit button
                            row +=        "<button type='button' style='margin-right:5px' class='edit-modal-academicYears btn btn-primary btn-sm' data-id='" + data.academic_year_id +"' data-year='" + data.year +  "' data-description='" + data.description + "'>";
                            row +=        "Edit";
                            row +=        "</button>";

                                    //  Delete button
                            row +=        "<button type='button' style='margin-right:5px' class='delete-modal-academicYears btn btn-danger btn-sm' data-id='" + data.academic_year_id + "'>";
                            row +=        "Delete";
                            row +=        "</button>";                                                
                            row +=        "</td>";
                            row +=  "</tr>";
                            
                            $('.item' + data.academic_year_id + '-academicYears').replaceWith(row);
                                                
                        }
                    }
                });
            });
// End academic years - scripts


// Gradings System Scripts

    // delete function
    $(document).on('click', '.delete-modal-gradings', function() {
                $('#deleteModal-gradings').modal('show');
                id = $(this).data('id');
            });
            $('.modal-footer').on('click', '.delete-gradings', function() {
                $.ajax({
                    type: 'DELETE',
                    url: 'gradings/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(data) {
                    toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});

                    //Remove table row    
                        $('.item' + id + '-gradings').remove();                    
                    }
                });
            });

    //Update function
    $(document).on('click', '.edit-modal-gradings', function() {
                //Get academicYear for Title
                grade = $(this).data('grade');
                //Take id value
                id = $(this).data('id')

                //Set Modal title
                $('.modalTitleEdit-gradings').text('Edit Grade: '+ grade);

                //Fill values in modal            
                $('#grade_edit-gradings').val($(this).data('grade'));
                $('#points_edit-gradings').val($(this).data('points'));


                //Show modal
                $('#editModal-gradings').modal('show');
            });
            $('.modal-footer').on('click', '.update-gradings', function() {
                $.ajax({
                    type: 'PUT',
                    url: 'gradings/' + id,
                    data: {
                        //Pass current values to backend
                        '_token': $('input[name=_token]').val(),
                        'id': id,
                        'grade': $('#grade_edit-gradings').val(),
                        'points': $('#points_edit-gradings').val()
                    },

                    success: function(data) {

                        if ((data.errors)) {
                                
                            setTimeout(function () {
                                $('#editModal-gradings').modal('show');
                                toastr.error('Validation error.', 'Whoops! Something went wrong,', {timeOut: 5000});
                            }, 500);


                            if (data.errors.grade) {
                                $('.errorGrade-gradings').removeClass('hidden');
                                $('.errorGrade-gradings').text(data.errors.grade);
                            }

                            if (data.errors.points) {
                                $('.errorPoints-gradings').removeClass('hidden');
                                $('.errorPoints-gradings').text(data.errors.points);
                            }


                        } else {
                            // clear error messages
                            $('.errorGrade-gradings').text('');
                            $('.errorPoints-gradings').text('');


                            toastr.success('Successfully updated.', 'Success Alert', {timeOut: 5000});
                            row  =  "<tr class='item" + data.id + "-gradings'>";
                            row +=        "<td>" + data.grade + "</td>";
                            row +=        "<td>" + data.points + "</td>";

                                    // Action buttons
                            row +=        "<td>";
                                    // Edit button
                            row +=        "<button type='button' style='margin-right:5px' class='edit-modal-gradings btn btn-primary btn-sm' data-id='" + data.id +"' data-grade='" + data.grade +  "' data-points='" + data.points + "'>";
                            row +=        "Edit";
                            row +=        "</button>";

                                    //  Delete button
                            row +=        "<button type='button' style='margin-right:5px' class='delete-modal-gradings btn btn-danger btn-sm' data-id='" + data.id + "'>";
                            row +=        "Delete";
                            row +=        "</button>";                                                
                            row +=        "</td>";
                            row +=  "</tr>";
                            
                            $('.item' + data.id + '-gradings').replaceWith(row);
                                                
                        }
                    }
                });
            });
// End gradings system - scripts


// Specialized Areas Scripts

    // delete function
    $(document).on('click', '.delete-modal-specializedAreas', function() {
                $('#deleteModal-specializedAreas').modal('show');
                id = $(this).data('id');
            });
            $('.modal-footer').on('click', '.delete-specializedAreas', function() {
                $.ajax({
                    type: 'DELETE',
                    url: 'specialized_areas/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(data) {
                    toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});

                    //Remove table row    
                        $('.item' + id + '-specializedAreas').remove();                    
                    }
                });
            });

    //Update function
    $(document).on('click', '.edit-modal-specializedAreas', function() {
                //Get Name for Title
                name = $(this).data('name');
                //Take id value
                id = $(this).data('id')

                //Set Modal title
                $('.modalTitleEdit-specializedAreas').text('Edit Specialized Area: '+ name);

                //Fill values in modal            
                $('#description_edit-specializedAreas').val($(this).data('description'));
                $('#name_edit-specializedAreas').val($(this).data('name'));


                //Show modal
                $('#editModal-specializedAreas').modal('show');
            });
            $('.modal-footer').on('click', '.update-specializedAreas', function() {
                $.ajax({
                    type: 'PUT',
                    url: 'specialized_areas/' + id,
                    data: {
                        //Pass current values to backend
                        '_token': $('input[name=_token]').val(),
                        'specialized_area_id': id,
                        'name': $('#name_edit-specializedAreas').val(),
                        'description': $('#description_edit-specializedAreas').val()
                    },

                    success: function(data) {

                        if ((data.errors)) {
                                
                            setTimeout(function () {
                                $('#editModal-specializedAreas').modal('show');
                                toastr.error('Validation error.', 'Whoops! Something went wrong,', {timeOut: 5000});
                            }, 500);


                            if (data.errors.name) {
                                $('.errorName-specializedAreas').removeClass('hidden');
                                $('.errorName-specializedAreas').text(data.errors.name);
                            }

                            if (data.errors.description) {
                                $('.errorDescription-specializedAreas').removeClass('hidden');
                                $('.errorDescription-specializedAreas').text(data.errors.description);
                            }


                        } else {
                            // clear error messages
                            $('.errorName-specializedAreas').text('');
                            $('.errorDescription-specializedAreas').text('');


                            toastr.success('Successfully updated.', 'Success Alert', {timeOut: 5000});
                            row  =  "<tr class='item" + data.specialized_area_id + "-specializedAreas'>";
                            row +=        "<td>" + data.name + "</td>";
                            row +=        "<td>" + data.description + "</td>";

                                    // Action buttons
                            row +=        "<td>";
                                    // Edit button
                            row +=        "<button type='button' style='margin-right:5px' class='edit-modal-specializedAreas btn btn-primary btn-sm' data-id='" + data.specialized_area_id +"' data-name='" + data.name +  "' data-description='" + data.description + "'>";
                            row +=        "Edit";
                            row +=        "</button>";

                                    //  Delete button
                            row +=        "<button type='button' style='margin-right:5px' class='delete-modal-specializedAreas btn btn-danger btn-sm' data-id='" + data.specialized_area_id + "'>";
                            row +=        "Delete";
                            row +=        "</button>";                                                
                            row +=        "</td>";
                            row +=  "</tr>";
                            
                            $('.item' + data.specialized_area_id + '-specializedAreas').replaceWith(row);
                                                
                        }
                    }
                });
            });
// End Specialized Areas - scripts

</script>





@endsection