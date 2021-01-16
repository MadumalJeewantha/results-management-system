@extends('layouts.dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
               Subjects 
               <a href="/dashboard" class="btn btn-default pull-right" style="margin-left:5px">Back</a>
               @if( (Auth()->user()->type) == 'dean')            
                    <a href="subjects/create" class="btn btn-success pull-right">Add New Subject</a>
                @endif
            </h1>
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="glyphicon glyphicon-list"></i> Subjects
                    </li>                     
                </ol>
        </div>

        <div class="col-lg-12">
                @if(count($subjects)> 0)

                    @if(count($courses)> 0)
                        <div class="panel-group" id="subjects">
                        @foreach($courses as $course)
                                
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#subjects" href="#collapse{{$course->course_id}}">{{$course->name}} - {{$course->description}}</a>
                                      </h3>
                                    </div>
                                    <div id="collapse{{$course->course_id}}" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            
                                            <div class="well">
                                            <h3><strong>Year 1 - Semester 1</strong></h3>
                                                <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Status</th>
                                                                <th>Conducted By</th>
                                                                <th>Actions</th>
                                                        </tr>
                                                @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '1' && $subject->semester == '1')
                                                                    <tr>    
                                                                        <td>{{$subject->subject_code}}</td>
                                                                        <td>{{$subject->title}}</td>
                                                                        <td>{{$subject->credits}}</td>
                                                                        <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                        <td>{{$subject->department->name}} Department</td>

                                                                        @if( (Auth()->user()->type) == 'dean')
                                                                            <td>
                                                                                {{-- Edit button --}}
                                                                                <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                                    Edit
                                                                                </a>
                                        
                                                                                {{-- Delete button --}}
                                                                                <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                                    Delete
                                                                                </button> 
                                                                            </td> 
                                                                        @endif
                                                                    </tr>
                                                                @endif
                                                @endforeach 
                                                </table>
                                            </div>
                                            {{-- End Year 1 - Semester 1 --}}

                                            <div class="well">
                                            <h3><strong>Year 1 - Semester 2</strong></h3>
                                                <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Status</th>
                                                                <th>Conducted By</th>
                                                                <th>Actions</th>
                                                        </tr>
                                                @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '1' && $subject->semester == '2')
                                                                    <tr>    
                                                                        <td>{{$subject->subject_code}}</td>
                                                                        <td>{{$subject->title}}</td>
                                                                        <td>{{$subject->credits}}</td>
                                                                        <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                        <td>{{$subject->department->name}} Department</td>

                                                                        @if( (Auth()->user()->type) == 'dean')
                                                                            <td>
                                                                                {{-- Edit button --}}
                                                                                <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                                    Edit
                                                                                </a>
                                        
                                                                                {{-- Delete button --}}
                                                                                <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                                    Delete
                                                                                </button> 
                                                                            </td> 
                                                                        @endif
                                                                    </tr>
                                                                @endif
                                                @endforeach
                                                </table> 
                                            </div>
                                            {{-- End Year 1 - Semester 2 --}}

                                            <div class="well">
                                            <h3><strong>Year 2 - Semester 1</strong></h3>
                                                <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Status</th>
                                                                <th>Conducted By</th>
                                                                <th>Actions</th>
                                                        </tr>
                                                @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '2' && $subject->semester == '1')
                                                                    <tr>    
                                                                        <td>{{$subject->subject_code}}</td>
                                                                        <td>{{$subject->title}}</td>
                                                                        <td>{{$subject->credits}}</td>
                                                                        <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                        <td>{{$subject->department->name}} Department</td>

                                                                        @if( (Auth()->user()->type) == 'dean')
                                                                            <td>
                                                                                {{-- Edit button --}}
                                                                                <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                                    Edit
                                                                                </a>
                                        
                                                                                {{-- Delete button --}}
                                                                                <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                                    Delete
                                                                                </button> 
                                                                            </td> 
                                                                        @endif
                                                                    </tr>
                                                                @endif
                                                @endforeach 
                                                </table>
                                            </div>
                                            {{-- End Year 2 - Semester 1 --}}

                                            <div class="well">
                                            <h3><strong>Year 2 - Semester 2</strong></h3>
                                                <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                                <th>Subject Code</th>
                                                                <th>Title</th>
                                                                <th>Credits</th>
                                                                <th>Status</th>
                                                                <th>Conducted By</th>
                                                                <th>Actions</th>
                                                        </tr>
                                                @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '2' && $subject->semester == '2')
                                                                    <tr>    
                                                                        <td>{{$subject->subject_code}}</td>
                                                                        <td>{{$subject->title}}</td>
                                                                        <td>{{$subject->credits}}</td>
                                                                        <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                        <td>{{$subject->department->name}} Department</td>

                                                                        @if( (Auth()->user()->type) == 'dean')
                                                                            <td>
                                                                                {{-- Edit button --}}
                                                                                <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                                    Edit
                                                                                </a>
                                        
                                                                                {{-- Delete button --}}
                                                                                <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                                    Delete
                                                                                </button> 
                                                                            </td> 
                                                                        @endif
                                                                    </tr>
                                                                @endif
                                                @endforeach
                                                </table> 
                                            </div>
                                            {{-- End Year 2 - Semester 2 --}}

                                            {{-- Specialization begins at third year --}}
                                            <div class="well">
                                            <h3><strong>Year 3 - Semester 1</strong></h3>
                                                {{-- if there are specialized areas to relevent course --}}
                                                {{-- Should show here --}}
                                                @foreach($specializedAreas as $specializedArea)
                                        
                                                <table class="table table-striped table-bordered table-hover">
                                                   
                                                    <br>
                                                    <h4>Specialized Area: {{($specializedArea->name == 'Not Specified') ? 'Common Subjects' : $specializedArea->name }}</h4>
                                                        <tr>
                                                            <th>Subject Code</th>
                                                            <th>Title</th>
                                                            <th>Credits</th>
                                                            <th>Status</th>
                                                            <th>Conducted By</th>
                                                            <th>Actions</th>
                                                        </tr>

                                                        @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '3' && $subject->semester == '1' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                                                <tr>    
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{$subject->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                    <td>{{$subject->department->name}} Department</td>

                                                                    @if( (Auth()->user()->type) == 'dean')
                                                                    <td>
                                                                        {{-- Edit button --}}
                                                                        <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                            Edit
                                                                        </a>
                                
                                                                        {{-- Delete button --}}
                                                                        <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                            Delete
                                                                        </button> 
                                                                     </td> 
                                                                    @endif
                                                                </tr>
                                                                @endif
                                                        @endforeach 
                                                    
                                                </table>
                                                @endforeach
                                            </div>
                                                {{-- End Year 3 - Semester 1    --}}

                                            <div class="well">
                                            <h3><strong>Year 3 - Semester 2</strong></h3>
                                            @foreach($specializedAreas as $specializedArea)                                                    

                                            <table class="table table-striped table-bordered table-hover">
                                                    
                                                    <br>
                                                    <h4>Specialized Area: {{($specializedArea->name == 'Not Specified') ? 'Common Subjects' : $specializedArea->name }}</h4>
                                                        <tr>
                                                            <th>Subject Code</th>
                                                            <th>Title</th>
                                                            <th>Credits</th>
                                                            <th>Status</th>
                                                            <th>Conducted By</th>
                                                            <th>Actions</th>
                                                        </tr>

                                                        @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '3' && $subject->semester == '2' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                                                <tr>
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{$subject->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                    <td>{{$subject->department->name}} Department</td>

                                                                    @if( (Auth()->user()->type) == 'dean')
                                                                    <td>
                                                                        {{-- Edit button --}}
                                                                        <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                            Edit
                                                                        </a>
                                
                                                                        {{-- Delete button --}}
                                                                        <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                            Delete
                                                                        </button> 
                                                                     </td> 
                                                                    @endif
                                                                </tr>
                                                                @endif
                                                        @endforeach                                                     
                                                </table>
                                                @endforeach
                                            </div>   
                                                {{-- End Year 3 - Semester 2 --}}

                                            <div class="well">                                            
                                            <h3><strong>Year 4 - Semester 1</strong></h3>
                                            @foreach($specializedAreas as $specializedArea)
                                                    
                                            <table class="table table-striped table-bordered table-hover">
                                                    
                                                    <br>
                                                    <h4>Specialized Area: {{($specializedArea->name == 'Not Specified') ? 'Common Subjects' : $specializedArea->name }}</h4>
                                                        <tr>
                                                            <th>Subject Code</th>
                                                            <th>Title</th>
                                                            <th>Credits</th>
                                                            <th>Status</th>
                                                            <th>Conducted By</th>
                                                            <th>Actions</th>
                                                        </tr>

                                                        @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '4' && $subject->semester == '1' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                                                <tr>
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{$subject->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                    <td>{{$subject->department->name}} Department</td>

                                                                    @if( (Auth()->user()->type) == 'dean')
                                                                    <td>
                                                                        {{-- Edit button --}}
                                                                        <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                            Edit
                                                                        </a>
                                
                                                                        {{-- Delete button --}}
                                                                        <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                            Delete
                                                                        </button> 
                                                                     </td> 
                                                                    @endif
                                                                </tr>
                                                                @endif
                                                        @endforeach                                                     
                                                </table> 
                                                @endforeach  
                                            </div>
                                                {{-- End Year 4 - Semester 1 --}}


                                            <div class="well">                                            
                                            <h3><strong>Year 4 - Semester 2</strong></h3>
                                            @foreach($specializedAreas as $specializedArea)
                                                    
                                            <table class="table table-striped table-bordered table-hover">
                                                    
                                                    <br>
                                                    <h4>Specialized Area: {{($specializedArea->name == 'Not Specified') ? 'Common Subjects' : $specializedArea->name }}</h4>
                                                        <tr>
                                                            <th>Subject Code</th>
                                                            <th>Title</th>
                                                            <th>Credits</th>
                                                            <th>Status</th>
                                                            <th>Conducted By</th>
                                                            <th>Actions</th>
                                                        </tr>

                                                        @foreach($subjects as $subject)
                                                                @if($subject->course_id == $course->course_id &&  $subject->year == '4' && $subject->semester == '2' && $specializedArea->specialized_area_id == $subject->specialized_area_id)
                                                                <tr>
                                                                    <td>{{$subject->subject_code}}</td>
                                                                    <td>{{$subject->title}}</td>
                                                                    <td>{{$subject->credits}}</td>
                                                                    <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                                    <td>{{$subject->department->name}} Department</td>

                                                                    @if( (Auth()->user()->type) == 'dean')
                                                                    <td>
                                                                        {{-- Edit button --}}
                                                                        <a href="/subjects/{{$subject->subject_code}}/edit" class="edit-modal btn btn-primary btn-sm" >
                                                                            Edit
                                                                        </a>
                                
                                                                        {{-- Delete button --}}
                                                                        <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $subject->subject_code }}">
                                                                            Delete
                                                                        </button> 
                                                                     </td> 
                                                                    @endif
                                                                </tr>
                                                                @endif
                                                        @endforeach 
                                                    
                                                </table>  
                                                @endforeach
                                            </div> 
                                                {{--End Year 4 - Semester 2 --}}


                                        </div>
                                    </div>
                                  </div>
                                 
                        @endforeach
                        </div>                        
                    @endif
                    
                @else
                    <p class="alert alert-warning">You don't have any subject yet.</p>
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
                url: 'subjects/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                   toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});
                   
                   //Reload cuttrnt page from the server 
                   //Because after deleting row not refreshed TadaTables cash
                   //It gives deleted values ehen searchnig
                   location.reload(true); 

                                        
                }
            });
        });
</script>  

@endsection