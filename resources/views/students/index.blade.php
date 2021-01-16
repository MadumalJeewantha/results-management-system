@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {
        // $('#students').DataTable();
        // $('#students').DataTable( {
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'copy', 'excel', 'pdf','print'
        //         ]
        // } );
        //Provide column names to print

        $('#students').DataTable( {
        dom: 'Blfrtip',
        buttons: [
       {
           extend: 'pdf',
           footer: true,
           title: 'Student Details - Results Management System | FMSC',
           pageSize: 'A4',
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
       },
       {
           extend: 'csv',
           footer: false,
           title: 'Student Details - Results Management System | FMSC',
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
          
       },
       {
           extend: 'excel',
           footer: false,
           title: 'Student Details - Results Management System | FMSC',
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
       },
       {
           extend: 'copy',
           footer: false,
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
       },
       {
           extend: 'print',
           footer: true,
           title: 'Student Details - Results Management System | FMSC',
           exportOptions: {
                columns: [0,1,2,3,4,5,6]
            }
       }            
    ]  
    } );


    } );
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
               Students 
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a> 
               @if( (Auth()->user()->type) == 'dean' || (Auth()->user()->type) == 'ar')                               
                    <a href="students/create" class="btn btn-success pull-right">Add New Student</a>                   
                @endif
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-user"></i> Students
                    </li>                     
                </ol>
        </div>

        <div class="col-lg-12">
                @if(count($students)> 0)
                    <table class="table table-striped table-bordered table-hover" id="students">
                        <thead>
                            <tr>
                                <th>Registration No.</th>
                                <th>Index No.</th>
                                <th>Academic Year</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Department</th>

                                {{-- Action buttons --}}
                                {{-- Should use auth logics to show buttons --}}
                                <th width="150px">Actions</th>                                    
                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($students as $student)                    
                                    <tr class="item{{$student->student_registration_number}}">
                                        <td>{{$student->student_registration_number}}</td>
                                        <td>{{$student->student_index_number}}</td>
                                        <td>{{$student->academicyear->year}}</td>
                                        <td>{{$student->first_name}}</td>
                                        <td>{{$student->last_name}}</td>
                                        <td>{{$student->course->name}}</td>
                                        <td>{{$student->department->name}}</td>

                                        {{-- Action buttons --}}
                                        <td>
                                                {{-- View button --}}
                                                <a href="/students/{{$student->student_registration_number}}" class="btn btn-default btn-sm">View</a>
            
                                                @if( (Auth()->user()->type) == 'dean' || (Auth()->user()->type) == 'ar')            
                                                    {{-- Edit button --}}
                                                    <a href="/students/{{$student->student_registration_number}}/edit" class="btn btn-primary btn-sm">Edit</a>

                                                    {{-- Delete button --}}
                                                    <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $student->student_registration_number }}">
                                                    Delete
                                                    </button>  
                                                @endif                                              
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>         
                @else
                    <p class="alert alert-warning">You don't have any student yet.</p>
                @endif

                    
        </div>


</div>
{{-- end row --}}

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


<script>
// delete function
$(document).on('click', '.delete-modal', function() {
            $('#deleteModal').modal('show');
            id = $(this).data('id');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'students/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                   toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});
                   
                   //Reload cuttrnt page from the server 
                   //Because after deleting row not refreshed TadaTables cash
                   //It gives deleted values ehen searchnig
                   location.reload(true); 
                   //Remove table row    
                    $('.item' + id).remove();
                                        
                }
            });
        });

</script>    
@endsection