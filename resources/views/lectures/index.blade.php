@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {
            $('#lectures').DataTable( {
            dom: 'Blfrtip',
            buttons: [
        {
            extend: 'pdf',
            footer: true,
            title: 'Lecture Details - Results Management System | FMSC',
            pageSize: 'A4',
            exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
        },
        {
            extend: 'csv',
            footer: false,
            title: 'Lecture Details - Results Management System | FMSC',
            exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
            
        },
        {
            extend: 'excel',
            footer: false,
            title: 'Lecture Details - Results Management System | FMSC',
            exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
        },
        {
            extend: 'copy',
            footer: false,
            exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
        },
        {
            extend: 'print',
            footer: true,
            title: 'Lecture Details - Results Management System | FMSC',
            exportOptions: {
                    columns: [0,1,2,3,4,5]
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
                    Lecturers
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>          
               @if( (Auth()->user()->type) == 'dean' || (Auth()->user()->type) == 'ar')  
                <a href="lectures/create" class="btn btn-success pull-right">Add New Lecturer</a>
               @endif
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-user"></i> Lecturers
                    </li>                     
                </ol>
        </div>
        
        

        <div class="col-lg-12">
                @if(count($lectures)> 0)


                <div class="jumbotron">
                        <p> Lecturers population according to the departments</p>
                        <div> {!! $lecturesCountChart->render() !!}</div>
                </div>
                
                    <table class="table table-striped table-bordered table-hover" id="lectures">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Department</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>

                                {{-- Action buttons --}}
                                {{-- Should use auth logics to show buttons --}}
                                <th width="150px">Actions</th>                                    
                            </tr>                            
                        </thead>

                        <tbody>  
                            @foreach($lectures as $lecture)                    
                                    <tr class="item{{$lecture->employee_id}}">

                                        <td>{{$lecture->employee_id}}</td>
                                        <td>{{$lecture->department->name}}</td>
                                        <td>{{$lecture->first_name}}</td>
                                        <td>{{$lecture->last_name}}</td>
                                        <td>{{$lecture->email}}</td>
                                        <td>{{$lecture->mobile}}</td>

                                        {{-- Action buttons --}}
                                        <td>
                                                {{-- View button --}}
                                                <a href="/lectures/{{$lecture->employee_id}}" class="btn btn-default btn-sm">View</a>
                                           
                                            @if( (Auth()->user()->type) == 'dean' || (Auth()->user()->type) == 'ar')                                                        
                                                {{-- Edit button --}}
                                                <a href="/lectures/{{$lecture->employee_id}}/edit" class="btn btn-primary btn-sm">Edit</a>

                                                {{-- Delete button --}}
                                                <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $lecture->employee_id }}">
                                                Delete
                                                </button>  
                                            @endif

                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>         
                @else
                    <p class="alert alert-warning">You don't have any lecturer yet.</p>
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
                url: 'lectures/' + id,
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