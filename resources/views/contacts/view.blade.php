@extends('layouts.dashboard')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Message Box <a href="/contact" style="margin:5px" class="btn btn-default pull-right">Back</a>
               <button type="button" style="margin:5px" class="delete-modal btn btn-danger pull-right" data-id="{{ $contact->id}}">
                    Delete
                </button>
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li>
                        <i class="glyphicon glyphicon-envelope"></i>  <a href="/contact">Messages</a>
                    </li>
                    <li class="active">
                            <i class="glyphicon glyphicon-eye-open"></i> {{$contact->subject}}
                        </li>                       
                </ol>
        </div>



        <div class="col-lg-12">
                <div class="panel panel-default">
                <div class="panel-heading">{{$contact->subject}} - {{$contact->created_at->diffForHumans()}}</div>
                        <div class="panel-body">
                                Sender Name : <strong>{{$contact->name}}</strong> <br>
                                Email       : <strong>{{$contact->email}}</strong> <br>
                                <hr>
                                Message     : <strong>{{$contact->message}}</strong> <br><br>
                                
                                {!! Form::open(['action' => ['ContactsController@update' , $contact->id ], 'method'=>'POST' , 'class' => 'form-horizontal' ]) !!}
                                <input type="hidden" id="name" name="name" value="{{$contact->name}}">
                                <input type="hidden" id="email" name="email" value="{{$contact->email}}">
                                <input type="hidden" id="message" name="message" value="{{$contact->message}}">
                                <input type="hidden" id="subject" name="subject" value="{{$contact->subject}}">



                                <div class="form-group{{ $errors->has('reply') ? ' has-error' : '' }}">
                                        <label class="control-label control-label-left col-sm-1" for="reply">Reply</label>
                                        <div class="controls col-sm-11">
                                            <textarea id="reply" rows="3"  class="form-control"   placeholder="Enter reply message here" name="reply" type="text" required>{{$contact->reply}}</textarea>

                                            @if ($errors->has('reply'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('reply') }}</strong>
                                            </span>
                                            @endif                            
                                        </div>                                       
                                    </div>

                                    <div> 
                                        <br> 
                                        <button type="submit"  class="btn btn-success pull-right" style="margin:5px">Send</button>
                                    </div>
                                {{Form::hidden('_method', 'PUT')}}
                                {!! Form::close() !!}
                                
                        </div>                        
                </div>
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
                url: '/contact/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                   toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});
                   window.location = "/contact";                   
                }
            });
        });

</script>

@endsection