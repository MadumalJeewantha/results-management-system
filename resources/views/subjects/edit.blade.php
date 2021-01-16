@extends('layouts.dashboard')

@section('content')


<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit Subject: <strong>{{$subject->subject_code}}-{{$subject->title}}</strong> 

            <a href="/subjects" class="btn btn-default pull-right" style="margin:5px">Back</a>

            @if( (Auth()->user()->type) == 'dean')            
            {{-- Delete button --}}
            <button type="button" data-id="{{$subject->subject_code}}" class="delete-modal btn btn-danger pull-right" style="margin:5px">
                Delete
            </button>
            @endif
        </h1>

        <ol class="breadcrumb">
            <li>
                <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
            </li>
            <li>
                <i class="glyphicon glyphicon-list"></i>  <a href="/subjects">Subjects</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-pencil"></i> Edit
            </li>
        </ol>
    </div>
</div>



<div class="row col-lg-12">

    {!! Form::open(['action' => ['SubjectsController@update' , $subject->subject_code ], 'method'=>'POST' , 'class' => 'form-horizontal' ]) !!}
    <div class="container-fluid shadow ">
        <div class="row ">               

            <div class="row">
                <div class="col-md-6">


                    <!--subject_code-->
                    <div class="form-group{{ $errors->has('subject_code') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="subject_code">Subject Code<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <input type="text" name="subject_code" id="subject_code" placeholder="Subject Code" class="form-control" value="{{$subject->subject_code}}" required readonly/>
                            @if ($errors->has('subject_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject_code') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>

                    <!--title-->
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="title">Title<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <input type="text" name="title" id="title" placeholder="Course Title" class="form-control" value="{{$subject->title}}" required />
                            @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>

                    {{-- course_id --}}
                    <div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="course_id">Course<span class="req"> *</span></label>
                        <div class="controls col-sm-9">                           
                            <select class="form-control" data-role="select" selected="selected" required="required" name="course_id" id="course_id">
                                @foreach($courses as $course)
                                <option value="{{$course->course_id}}" {{($course->course_id == $subject->course_id) ? 'selected' : '' }}>
                                    {{$course->name}}
                                </option>                            
                                @endforeach 
                            </select>
                            @if ($errors->has('course_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('course_id') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>                           

                    <!--specialized_area_id-->
                    <div class="form-group{{ $errors->has('specialized_area_id') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="specialized_area_id">Specialized Area<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <select class="form-control" data-role="select" selected="selected" name="specialized_area_id" id="specialized_area_id" required="required">                                       
                                @foreach($specializedAreas as $specializedArea)
                                <option value="{{$specializedArea->specialized_area_id}}" {{($specializedArea->specialized_area_id == $subject->specialized_area_id) ? 'selected' : '' }}>
                                    {{$specializedArea->name}}
                                </option>                            
                                @endforeach 
                            </select>
                            @if ($errors->has('specialized_area_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('specialized_area_id') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>

                    <!--department_id-->
                    <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="department_id">Conducted By<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <select  class="form-control" data-role="select" selected="selected" id="department_id" name="department_id" required="required">                                                
                                @foreach($departments as $department)
                                <option value="{{$department->department_id}}" {{($department->department_id == $subject->department_id) ? 'selected' : ''}}>
                                    {{$department->name}}
                                </option>                            
                                @endforeach 
                            </select>   
                            @if ($errors->has('department_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('department_id') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>

                </div>



                <div class="col-md-6">

                    <!--credits-->
                    <div class="form-group{{ $errors->has('credits') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="credits">Credits<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <input type="text" name="credits" id="credits" placeholder="Credits" class="form-control" value="{{$subject->credits}}" required/>
                            @if ($errors->has('credits'))
                            <span class="help-block">
                                <strong>{{ $errors->first('credits') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>

                    <!--status-->
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="status">Status<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <select  class="form-control" data-role="select" selected="selected" id="status" name="status" required="required">                                                
                                <option value="1" {{($subject->status == '1') ? 'selected' : ''}}>
                                    Compulsory
                                </option>

                                <option value="2" {{($subject->status == '2') ? 'selected' : ''}}>
                                    Optional
                                </option> 

                                <option value="3" {{($subject->status == '3') ? 'selected' : ''}}>
                                    Major
                                </option>

                                <option value="4" {{($subject->status == '4') ? 'selected' : ''}}>
                                    Electives
                                </option>                                                             
                            </select> 
                            @if ($errors->has('status'))
                            <span class="help-block">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>

                    <!--year-->
                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="year">Year<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <select  class="form-control" data-role="select" selected="selected" id="year" name="year" required="required">                                                
                                <option value="1" {{($subject->year == '1') ? 'selected' : ''}}>
                                    One
                                </option>

                                <option value="2" {{($subject->year == '2') ? 'selected' : ''}}>
                                    Two
                                </option> 

                                <option value="3" {{($subject->year == '3') ? 'selected' : ''}}>
                                    Three
                                </option>

                                <option value="4" {{($subject->year == '4') ? 'selected' : ''}}>
                                    Four
                                </option>                                                             
                            </select>  
                            @if ($errors->has('year'))
                            <span class="help-block">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>

                    <!--semester-->
                    <div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
                        <label class="control-label control-label-left col-sm-3" for="semester">Semester<span class="req"> *</span></label>
                        <div class="controls col-sm-9">
                            <select  class="form-control" data-role="select" selected="selected" id="semester" name="semester" required="required">                                                
                                <option value="1" {{($subject->semester == '1') ? 'selected' : ''}}>
                                    One
                                </option>

                                <option value="2" {{($subject->semester == '2') ? 'selected' : ''}}>
                                    Two
                                </option>                                                                                      
                            </select>       
                            @if ($errors->has('semester'))
                            <span class="help-block">
                                <strong>{{ $errors->first('semester') }}</strong>
                            </span>
                            @endif   
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 10px">Update</button>

            </div>


        </div>
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {!! Form::close() !!}
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
                url: 'subjects/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                   toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});
                   
                   window.location = "/subjects";

                                        
                }
            });
        });
</script>  


@endsection
