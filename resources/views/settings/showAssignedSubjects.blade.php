@extends('layouts.dashboard')

@section('content')

<script>
    $(document).ready( function () {
        //Data table
        $('.subjects').DataTable();

        //Change event of specialized area 
       $("#academic_year_id").change(function () {
        
        //Get the selected value
        var selectedValue = $(this).val();                                 

        //Loop through values of select  
        $('#academic_year_id > option').each(function() {
            //Hide via jQuery
            $("#"+$(this).val()).hide();          
        });

        //Show via jQuery
        $("#"+selectedValue).show();
        
        });

    } );
</script>

<!-- Page Heading -->
<div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">
            Enrolled Subjects   <a href="/lecture_subjects" class="btn btn-default pull-right">Back</a>          
            </h1>
            
            <h4>Employee ID - <strong>{{$employee_id}}</strong></h4>
            <h4>Name - <strong>{{App\Lecture::find($employee_id)->first_name}}&nbsp;{{App\Lecture::find($employee_id)->last_name}}</strong></h4>
            <a href="/lecture_subjects/{{$employee_id}}/edit" class="btn btn-success">Enroll New Subject</a>                                                                                      
            
            <ol class="breadcrumb">
                    <li>
                        <i class="glyphicon glyphicon-dashboard"></i>  <a href="/dashboard">Dashboard</a>
                    </li>

                    <li>
                        <i class="glyphicon glyphicon-cog"></i>  <a href="/settings"> Settings </a>
                    </li> 

                    <li>
                        <i class="glyphicon glyphicon-user"></i> Lecturers
                    </li> 

                    <li class="active">
                        <i class="glyphicon glyphicon-eye-open"></i> View Enrolled Subjects
                    </li>                     
            </ol>

        </div>

        <div class="col-lg-12">
                <div class="col-md-10">
                        <div class="form-group{{ $errors->has('academic_year_id') ? ' has-error' : '' }}">
                                <label class="control-label control-label-left col-sm-3" for="academic_year_id">Academic Year</label>
                                <div class="controls col-sm-9">
                                    <select id="academic_year_id" class="form-control" data-role="select" required="required" selected="selected" name="academic_year_id">
                                       
                                       {{-- Set not selected one --}}
                                       <option>Select Academic Year</option>

                                        @foreach($academicYears as $academicYear)
                                            <option value="{{$academicYear->academic_year_id}}">
                                                {{$academicYear->year}}
                                            </option>                                                
                                        @endforeach                                                
                                    </select>                                                            
                                </div>
                        </div>
                </div>
                <br><br>
                <hr>

                {{-- Loop through aacademic years --}}
                @foreach($academicYears as $academicYear)                
                    <div id="{{$academicYear->academic_year_id}}" style="display:none">    
                    <table class="table table-striped table-bordered table-hover subjects">
                            <thead>
                                <tr>
                                        <th>Subject Code</th>
                                        <th>Title</th>
                                        <th>Credits</th>
                                        <th>Status</th>
                                        <th>Conducted By</th>
                                        <th>Actions</th>                                   
                                </tr>                            
                            </thead>
    
                            <tbody>
                                
                                    {{-- Loop through lectureSubjects --}}
                                    @foreach($lectureSubjects as $lectureSubject)

                                        {{-- Check academic year --}}
                                        @if($academicYear->academic_year_id == $lectureSubject->academic_year_id)
                                            {{-- Add that subject to table --}}
                                            <?php $subject = App\Subject::find($lectureSubject->subjects_subject_code) ?>
                                            <tr> 
                                                    <td>{{$subject->subject_code}}</td>
                                                    <td>{{$subject->title}}</td>
                                                    <td>{{$subject->credits}}</td>
                                                    <td>{{($subject->status == '1') ? 'Compulsory' : (($subject->status == '2') ? 'Optional' : (($subject->status == '3') ? 'Major' : (($subject->status == '4') ? 'Electives' : '' )))}}</td>
                                                    <td>{{$subject->department->name}} Department</td>                                
                                                    <td>
                                                        {{-- Delete button --}}
                                                        <button type="button" class="delete-modal btn btn-danger btn-sm" data-id="{{ $lectureSubject->assign_id }}">
                                                        Delete
                                                        </button> 
                                                    </td>
                                            </tr>   
                                        @endif
                                    @endforeach
                                
                            </tbody>
                    </table>
                    </div>                                  
                                            
                @endforeach
                    
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


<script type="text/javascript">
    // delete function
    $(document).on('click', '.delete-modal', function() {
                $('#deleteModal').modal('show');
                id = $(this).data('id');
            });
            $('.modal-footer').on('click', '.delete', function() {
                $.ajax({
                    type: 'DELETE',
                    url: '/lecture_subjects/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(data) {
                       toastr.success('Successfully deleted', 'Success Alert', {timeOut: 5000});

                    //Reload page   
                    location.reload(true);                  
                    }
                });
            });    
</script>    
     
@endsection