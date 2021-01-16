@extends('layouts.dashboard')

@section('content')



    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Department Details 
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
               <a href="departments/create" class="btn btn-success pull-right">Add New Department</a>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-education"></i> Departments
                    </li>                     
                </ol>
        </div>



        <div class="col-lg-12">
                        @if(count($departments)> 0)
                        <table class="table table-striped table-bordered table-hover" id="dept">
                                <tr>
                                    <th>Department Name</th>
                                    <th>Department Head Employee ID</th>
                                    <th>Description</th>

                                    {{-- Action buttons --}}
                                    <th width="150px">Actions</th>                                    
                                </tr>

                                @foreach($departments as $department)

                                    {{-- Skip showing 'Not Specified' department  --}}
                                    {{-- It keep as a default value --}}
                                    @if($department->name == "Not Specified")
                                        @continue
                                    @endif

                                <tr class="item{{$department->department_id}}">

                                        <td>{{$department->name}}</td>
                                        <td>{{$department->department_head_employee_id}}</td>
                                        <td>{{$department->description}}</td>

                                        {{-- Action buttons --}}
                                        <td>
                                                {{-- Edit button --}}
                                                <button type="button" class="edit-modal btn btn-primary" data-id="{{ $department->department_id }}" data-name="{{ $department->name }}" data-department_head_employee_id="{{ $department->department_head_employee_id }}" data-description="{{ $department->description }}">
                                                Edit
                                                </button>

                                                {{-- Delete button --}}
                                                <button type="button" class="delete-modal btn btn-danger" data-id="{{ $department->department_id }}">
                                                Delete
                                                </button>                                                
                                        </td>
                                </tr>
                                @endforeach
                        </table>
                        @else
                        <p class="alert alert-warning">You don't have any department.</p>
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
                              <h4 class="modal-title modalTitleEdit">Edit Department</h4>
                            </div>
                            <div class="modal-body">
                                        
                                        <form class="form-horizontal" role="form">                                               

                                             {{-- department_head_employee_id --}}
                                             <div class="form-group">
                                                    <label class="control-label col-sm-2" for="department_head_employee_id_edit">Department Head Employee ID<span class="req"> *</span></label>
                                                    <div class="col-sm-10">
                                                      <input type="text" required class="form-control" id="department_head_employee_id_edit" placeholder="Department Head Employee ID">
                                                                                 
                                                      <span class="help-block errorDepartment_head_employee_id hidden" style="color:#a94442">                                                        
                                                      </span>
                                                  </div>
                                                  </div>

                                                {{-- description --}}
                                                <div class="form-group">
                                                  <label class="control-label col-sm-2" for="description_edit">Description</label>
                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="description_edit" placeholder="Description">
                                                                               
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
                url: 'departments/' + id,
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
            //Get department name
            name = $(this).data('name');
            //Take id value
            id = $(this).data('id')

            //Set Modal title
            $('.modalTitleEdit').text('Edit Department: '+ name);

            //Fill values in modal            
            $('#description_edit').val($(this).data('description'));
            $('#department_head_employee_id_edit').val($(this).data('department_head_employee_id'));


            //Show modal
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.update', function() {
            $.ajax({
                type: 'PUT',
                url: 'departments/' + id,
                data: {
                    //Pass current values to backend
                    '_token': $('input[name=_token]').val(),
                    'department_id': id,
                    'name': name,
                    'department_head_employee_id': $('#department_head_employee_id_edit').val(),
                    'description': $('#description_edit').val()
                },

                success: function(data) {

                    if ((data.errors)) {
                            
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error.', 'Whoops! Something went wrong,', {timeOut: 5000});
                        }, 500);


                        if (data.errors.department_head_employee_id) {
                            $('.errorDepartment_head_employee_id').removeClass('hidden');
                            $('.errorDepartment_head_employee_id').text(data.errors.department_head_employee_id);
                        }

                        if (data.errors.description) {
                            $('.errorDescription').removeClass('hidden');
                            $('.errorDescription').text(data.errors.description);
                        }


                    } else {
                        // clear error messages
                        $('.errorDepartment_head_employee_id').text('');
                        $('.errorDescription').text('');


                        toastr.success('Successfully updated.', 'Success Alert', {timeOut: 5000});
                        row  =  "<tr class='item" + data.department_id + "'>";
                        row +=        "<td>" + data.name + "</td>";
                        row +=        "<td>" + data.department_head_employee_id + "</td>";
                        row +=        "<td>" + data.description + "</td>";

                                // Action buttons
                        row +=        "<td>";
                                // Edit button
                        row +=        "<button type='button' class='edit-modal btn btn-primary' data-id='" + data.department_id +"' data-name='" + data.name + "' data-department_head_employee_id='" + data.department_head_employee_id + "' data-description='" + data.description + "'>";
                        row +=        "Edit";
                        row +=        "</button>";

                                //  Delete button
                        row +=        "<button type='button' class='delete-modal btn btn-danger' data-id='" + data.department_id + "'>";
                        row +=        "Delete";
                        row +=        "</button>";                                                
                        row +=        "</td>";
                        row +=  "</tr>";
                        
                        $('.item' + data.department_id).replaceWith(row);
                                              
                    }
                }
            });
        });
</script>

@endsection