@extends('layouts.dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Course Details 
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
               <a href="courses/create" class="btn btn-success pull-right">Add New Course</a>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-education"></i> Courses
                    </li>                     
                </ol>
        </div>



        <div class="col-lg-12">
                        @if(count($courses)> 0)
                        <table class="table table-striped table-bordered table-hover" id="courses">
                                <tr>
                                    <th>Course Name</th>
                                    <th>Description</th>

                                    {{-- Action buttons --}}
                                    <th width="150px">Actions</th>                                    
                                </tr>

                                @foreach($courses as $course)
                                <tr class="item{{$course->course_id}}">

                                        <td>{{$course->name}}</td>
                                        <td>{{$course->description}}</td>

                                        {{-- Action buttons --}}
                                        <td>
                                                {{-- Edit button --}}
                                                <button type="button" class="edit-modal btn btn-primary" data-id="{{ $course->course_id }}" data-name="{{ $course->name }}" data-description="{{ $course->description }}">
                                                Edit
                                                </button>

                                                {{-- Delete button --}}
                                                <button type="button" class="delete-modal btn btn-danger" data-id="{{ $course->course_id }}">
                                                Delete
                                                </button>                                                
                                        </td>
                                </tr>
                                @endforeach
                        </table>                        
                        
                        @else
                        <p class="alert alert-warning">You don't have any course.</p>
                        @endif
        </div>        

    </div>        




        <!-- Delete Modal -->
        <div id="deleteModal" class="modal fade" role="dialog">
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
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">Delete</button>                        
                    </div>
                  </div>
              
                </div>
        </div>


         <!-- Edit Modal -->
         <div id="editModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                      
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#3097d1;color:#fff">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title modalTitleEdit">Edit Course</h4>
                            </div>
                            <div class="modal-body">
                                        
                                        <form class="form-horizontal" role="form">                                               

                                                {{-- description --}}
                                                <div class="form-group">
                                                  <label class="control-label col-sm-2" for="description_edit">Description</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="description_edit" placeholder="Enter Description">
                                                                               
                                                    <span class="help-block errorDescription hidden" style="color:#a94442">                                                        
                                                    </span>
                                                </div>
                                                </div>
                                               
                                        </form> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary update" data-dismiss="modal">Update</button>                        
                            </div>
                          </div>
                      
                        </div>
                </div>

        
<script type="text/javascript">

// delete function
$(document).on('click', '.delete-modal', function() {
            $('#deleteModal').modal('show');
            id = $(this).data('id');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'courses/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                   toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});

                   //Remove table row    
                    $('.item' + id).remove();                    
                }
            });
        });

//Update function
$(document).on('click', '.edit-modal', function() {
            //Get course name
            name = $(this).data('name');
            //Take id value
            id = $(this).data('id')

            //Set Modal title
            $('.modalTitleEdit').text('Edit Course: '+ name);

            //Fill values in modal            
            $('#description_edit').val($(this).data('description'));

            //Show modal
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.update', function() {
            $.ajax({
                type: 'PUT',
                url: 'courses/' + id,
                data: {
                    //Pass current values to backend
                    '_token': $('input[name=_token]').val(),
                    'course_id': id,
                    'name': name,
                    'description': $('#description_edit').val()
                },

                success: function(data) {

                    if ((data.errors)) {
                            
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error.', 'Whoops! Something went wrong,', {timeOut: 5000});
                        }, 500);


                        if (data.errors.description) {
                            $('.errorDescription').removeClass('hidden');
                            $('.errorDescription').text(data.errors.description);
                        }


                    } else {
                        // clear error messages
                        $('.errorDescription').text('');

                        toastr.success('Successfully updated.', 'Success Alert', {timeOut: 5000});
                        row  =  "<tr class='item" + data.course_id + "'>";
                        row +=        "<td>" + data.name + "</td>";
                        row +=        "<td>" + data.description + "</td>";

                                // Action buttons
                        row +=        "<td>";
                                // Edit button
                        row +=        "<button type='button' class='edit-modal btn btn-primary' data-id='" + data.course_id +"' data-name='" + data.name + "' data-description='" + data.description + "'>";
                        row +=        "Edit";
                        row +=        "</button>";

                                //  Delete button
                        row +=        "<button type='button' class='delete-modal btn btn-danger' data-id='" + data.course_id + "'>";
                        row +=        "Delete";
                        row +=        "</button>";                                                
                        row +=        "</td>";
                        row +=  "</tr>";
                        
                        $('.item' + data.course_id).replaceWith(row);
                                              
                    }
                }
            });
        });
</script>




@endsection