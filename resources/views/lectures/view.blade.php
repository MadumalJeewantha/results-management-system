@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                    Lecturer <strong>{{$lecture->employee_id}} </strong> 
               <a href="/lectures" class="btn btn-default pull-right" style="margin:5px">Back</a>

               @if( (Auth()->user()->type) == 'dean' || (Auth()->user()->type) == 'ar')            
                    {{-- Edit button --}}
                    <a href="/lectures/{{$lecture->employee_id}}/edit" class="btn btn-primary pull-right" style="margin:5px">Edit</a>

                    {{-- Delete button --}}
                    <button type="button" data-id="{{ $lecture->employee_id }}" class="delete-modal btn btn-danger pull-right" style="margin:5px" data-id="{{ $lecture->employee_id }}">
                    Delete
                    </button>  
               @endif 
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                     <li>
                        <i class="glyphicon glyphicon-user"></i>  <a href="/lectures">Lecturers</a>
                    </li>
                     <li class="active">
                        <i class="glyphicon glyphicon-eye-open"></i> View
                    </li>
                </ol>
        </div>
</div>

    <div class="row">
        
        {!! Form::open([ 'class'=> 'form-horizontal']) !!}

        <div class="container-fluid shadow">
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                        <div id="panel1" class="panel panel-default" data-role="panel">
                            <div class="panel-heading">Personal Details</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-6">

                                        <!--employee_id-->
                                        <div class="form-group">                                                
                                            <label class="control-label control-label-left col-sm-3" for="employee_id">Employee ID<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                            <input id="employee_id" class="form-control k-textbox" data-role="text" placeholder="Employee ID" name="employee_id" required="required"  type="text" value="{{$lecture->employee_id}}" readonly>                                                                                          
                                            </div>
                                        </div>

                                        <!--initials-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="initials">Initials<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="initials" class="form-control k-textbox" data-role="text" placeholder="Initials" name="initials" required="required"  type="text" value="{{$lecture->initials}}" readonly>                                                 
                                            </div>
                                        </div>

                                        <!--first_name-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="first_name">First Name<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="first_name" class="form-control k-textbox" data-role="text" placeholder="First Name" name="first_name" required="required" type="text" value="{{$lecture->first_name}}" readonly>                                    
                                            </div>
                                        </div>

                                        <!--last_name-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="last_name">Last Name</label>
                                            <div class="controls col-sm-9">
                                                <input id="last_name" class="form-control k-textbox" data-role="text" placeholder="Last Name" name="last_name" type="text" value="{{$lecture->last_name}}" readonly>
                                            </div>
                                        </div>

                                        <!--email-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="email">Email<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                    <input id="email" class="form-control k-textbox" data-role="text" placeholder="Email Address" name="email" type="text" value="{{$lecture->email}}" readonly>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="col-md-6">

                                        <!--department_id-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="department_name">Department <span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input id="department_name" class="form-control k-textbox" data-role="text" placeholder="Department Name" name="department_name" type="text" value="{{$lecture->department->name}}" readonly> 
                                            </div>
                                        </div>

                                        <!--mobile-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="mobile">Mobile</label>
                                            <div class="controls col-sm-9">
                                                <input id="mobile" class="form-control k-textbox" data-role="text" placeholder="Mobile Number" name="mobile" type="text" value="{{$lecture->mobile }}" readonly>
                                         </div>
                                        </div>

                                        <!--gender-->
                                        <div class="form-group" style="display: block;">
                                            <label class="control-label control-label-left col-sm-3">Gender<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                    @if($lecture->gender == 'Male')
                                                        <label class="radio" for="male">
                                                            <input value="Male" id="male" name="gender" required="required" checked="checked" type="radio">
                                                            Male
                                                        </label>
                                                    @else
                                                        <label class="radio" for="female">
                                                            <input value="Female" id="female" name="gender" required="required" checked="checked" type="radio">
                                                            Female
                                                        </label>
                                                    @endif
                                            </div>                                                                                        
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="panel2" class="panel panel-default" data-role="panel">
                            <div class="panel-heading">Quelification Details</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <!--qualifications-->
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="qualifications">Qualifications</label>
                                            <div class="controls col-sm-9">
                                                <textarea id="qualifications" placeholder="Tell about your qualifications" rows="3" class="form-control k-textbox" data-role="textarea" name="qualifications" style="height: 182px;" readonly> {{$lecture->qualifications}} </textarea>                                            
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="panel3" class="panel panel-default" data-role="panel">
                            <div class="panel-heading">Profile Picture</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <!--image thumbnail-->
                                        <div class="form-group">
                                            <div class="controls col-sm-9">
                                                <img class="img-fluid img-thumbnail p-3" id="uploadPreview" src="{{ $lecture->profile_picture}}" alt="Profile Picture"> 
                                            </div>
                                        </div>                                                                            

                                    </div>

                                    <!--bio-->
                                    <div class="col-md-5">
                                        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                                            <label class="control-label control-label-left col-sm-3" for="bio">Bio</label>
                                            <div class="controls col-sm-9">
                                            <textarea id="bio" rows="8" class="form-control k-textbox"   placeholder="Tell about yourself" name="bio" type="text" readonly> {{$lecture->bio}}</textarea>                                                                        
                                            </div>                                       
                                        </div>

                                        <div> 
                                            <br> 
                                            <a href="/lectures" class="btn btn-default pull-right" > Back</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>                                
                    </div>
                </div>

            </div>
        </div>

        {!!Form::close()!!}

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


<script>
        // delete function
        $(document).on('click', '.delete-modal', function() {
            $('#deleteModal').modal('show');
            id = $(this).data('id');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: '/lectures/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                   toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});
                   window.location = "/lectures";
                                                           
                }
            });
        });
</script>

@endsection