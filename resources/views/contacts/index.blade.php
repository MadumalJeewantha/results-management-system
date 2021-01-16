@extends('layouts.dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Message Box
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-envelope"></i> Messages
                    </li>                     
                </ol>
        </div>



        <div class="col-lg-12">
            @if(App\Contact::where('response', 0)->count() == 0)
                <p>You don't have any new message.</p>
            @endif
                        @if(count($contacts)> 0)
                        <table class="table table-bordered table-hover">
                                <tr>
                                    <th>Sender Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Received</th>

                                    {{-- Action buttons --}}
                                    <th width="150px">Actions</th>                                    
                                </tr>

                                @foreach($contacts as $contact)


                            <tr class="item{{$contact->id}} {{($contact->response == 0) ? 'success' : '' }}">

                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->subject}}</td>
                                        <td>{{$contact->created_at->diffForHumans()}}</td>



                                        {{-- Action buttons --}}
                                        <td>
                                                {{-- View button --}}
                                                <a href="/contact/{{$contact->id}}/edit" class="btn btn-primary btn-sm">View</a>

                                                {{-- Delete button --}}
                                                <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $contact->id }}">
                                                Delete
                                                </button>                                                
                                        </td>
                                </tr>
                                @endforeach
                        </table>
                        {{ $contacts->links() }}
                        @else
                        <p class="alert alert-warning">You don't have any message.</p>
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


         
        
<script type="text/javascript">

// delete function
$(document).on('click', '.delete-modal', function() {
            $('#deleteModal').modal('show');
            id = $(this).data('id');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'contact/' + id,
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

</script>

@endsection