<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Course;
use App\Department; 
use App\SpecializedArea;
use App\Student;
use App\User;
use App\Subject;
use App\StudentSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

class StudentsController extends Controller
{
    public function __construct()
    {
        //Set configuration middleware
        $this->middleware('config');
        //Set authentication middleware
        $this->middleware('auth');
        //Set middleware which can accessed by dean & ar only
        //Except index, show functions
        $this->middleware('ARorDean',['except'=> ['index','show']]);
        //Set student middleware
        $this->middleware('ifStudent'); 
        //Set lecture middleware
        //Except index, show functions
        $this->middleware('ifLecture',['except'=> ['index','show']]);

         
        //Index can view to lectures but Edit | Delete will be disabled
        //In view.blade Edit | Delete buttons should be disabled

    }

    public function findAcademicYears()
    {
        // if empty return error message
        //

        return AcademicYear::all();
    }

    public function findDepartments()
    {
        return Department::all();
    }

    public function findCourses()
    {
        return Course::all();
    }

    public function findSpecializedAreas()
    {
        return SpecializedArea::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Return students index page 
        //Options will change in view according to the Auth
        $students = Student::all();
        // $students = DB::table('students')->orderBy('student_registration_number');
        return view('students.index')->with('students',$students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Send AcademicYear | Course | SpecializedArea | Department details
        $academicYears = $this->findAcademicYears();
        $departments = $this->findDepartments();
        $courses = $this->findCourses();
        $specializedAreas = $this->findSpecializedAreas();

        //route for students creation
        return view('students.create')->with(['academicYears' => $academicYears,
            'departments' => $departments,
            'courses' => $courses,
            'specializedAreas' => $specializedAreas]);
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //validation
        $this->validate($request, [

            'student_registration_number' => 'required|unique:students',
            'student_index_number' => 'required|unique:students',
            'department_id' => 'nullable',
            'course_id' => 'required',
            'academic_year_id' => 'required',
            'specialized_area_id' => 'nullable',
            'initials' => 'required',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'nic_number' => 'required|unique:students|min:10',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'marriage_state' => 'required',
            'email' => 'email|nullable|unique:students',
            'contact_no_mobile' => 'nullable|min:10',
            'contact_no_home' => 'nullable|min:10',
            'home_address_1' => 'nullable',
            'home_address_2' => 'nullable',
            'home_address_3' => 'nullable',
            'current_address_1' => 'nullable',
            'current_address_2' => 'nullable',
            'current_address_3' => 'nullable',
            'fb_url' => 'nullable',
            'linkedin_url' => 'nullable',
            'father_name' => 'nullable',
            'father_occupation' => 'nullable',
            'mother_name' => 'nullable',
            'mother_occupation' => 'nullable',
            'number_of_sisters_and_brothers' => 'nullable',
            'dissertation_title' => 'nullable',
            'dissertation_published_link' => 'nullable',
            'supervisor_name' => 'nullable',
            'profile_picture' => 'image|nullable|max:1999',
            'bio' => 'nullable',
        ]);

        if ($request->hasFile('profile_picture')) {
            // $path = $request->file('profile_picture')->store('avatars'); Have to check cann assess outside of public directory
            $file = $request->file('profile_picture')->store('public/avatars');
            $path = str_replace("public/avatars","/storage/avatars",$file);

        } else {
            // $path = 'avatars/no_image.png';
            $path = '/storage/avatars/no_image.png';
        }

        // to see every input fields for testing purpose
        // return $request->all();

        // Create studnet
        $studnet = new Student;

        $studnet->student_registration_number = $request->input('student_registration_number');
        $studnet->student_index_number = $request->input('student_index_number');
        $studnet->department_id = $request->input('department_id');
        $studnet->course_id = $request->input('course_id');
        $studnet->academic_year_id = $request->input('academic_year_id');
        $studnet->specialized_area_id = $request->input('specialized_area_id');
        $studnet->initials = $request->input('initials');
        $studnet->first_name = $request->input('first_name');
        $studnet->last_name = $request->input('last_name');
        $studnet->nic_number = $request->input('nic_number');
        $studnet->date_of_birth = $request->input('date_of_birth');
        $studnet->gender = $request->input('gender');
        $studnet->marriage_state = $request->input('marriage_state');
        $studnet->email = $request->input('email');
        $studnet->contact_no_mobile = $request->input('contact_no_mobile');
        $studnet->contact_no_home = $request->input('contact_no_home');
        $studnet->home_address_1 = $request->input('home_address_1');
        $studnet->home_address_2 = $request->input('home_address_2');
        $studnet->home_address_3 = $request->input('home_address_3');
        $studnet->current_address_1 = $request->input('current_address_1');
        $studnet->current_address_2 = $request->input('current_address_2');
        $studnet->current_address_3 = $request->input('current_address_3');
        $studnet->fb_url = $request->input('fb_url');
        $studnet->linkedin_url = $request->input('linkedin_url');
        $studnet->father_name = $request->input('father_name');
        $studnet->father_occupation = $request->input('father_occupation');
        $studnet->mother_name = $request->input('mother_name');
        $studnet->mother_occupation = $request->input('mother_occupation');
        $studnet->number_of_sisters_and_brothers = $request->input('number_of_sisters_and_brothers');
        $studnet->dissertation_title = $request->input('dissertation_title');
        $studnet->dissertation_published_link = $request->input('dissertation_published_link');
        $studnet->supervisor_name = $request->input('supervisor_name');
        $studnet->profile_picture = $path;
        $studnet->bio = $request->input('bio');

        $studnet->save();

        //Add to user
         $user = new User;
         $user->user_name = $request->input('student_registration_number');
         $user->name = $request->input('first_name');
         $user->type = 'student';
         $user->email = $request->input('email');
         $user->password = bcrypt($request->input('student_registration_number'));
         $user->save();

        //Config subjects
        //Asign first & second year subjects autamatically
        //Because there is a fixed curriculum

        //Year 1 and Year 2
        $subjects = DB::table('subjects')->where([['course_id','=',$request->course_id],
                                                  ['year','=','1'],
                                                 ])
                                        ->orWhere([['course_id','=',$request->course_id],
                                                    ['year','=','2'],
                                                  ])->get();

        foreach($subjects as $subject){
            $student_subjects = new StudentSubjects;
            $student_subjects->students_stu_reg_no = $request->student_registration_number;
            $student_subjects->subjects_subject_code = $subject->subject_code;
            $student_subjects->save();
        }
    
        //Year 3 and Year 4 - Common Subjects
        //Only common subjects ->specilaized_area = Not Specified
        $specialized_area_id = SpecializedArea::where('name','=','Not Specified')->first()->specialized_area_id;

        $subjects = DB::table('subjects')->where([['course_id','=', $request->course_id],
                                                  ['year','=','3'],
                                                  ['specialized_area_id','=', $specialized_area_id],
                                                 ])
                                       ->orWhere([['course_id','=',$request->course_id],
                                                   ['year','=','4'],
                                                   ['specialized_area_id','=', $specialized_area_id],
                                                 ])->get();

        foreach($subjects as $subject){
        $student_subjects = new StudentSubjects;
        $student_subjects->students_stu_reg_no = $request->student_registration_number;
        $student_subjects->subjects_subject_code = $subject->subject_code;
        $student_subjects->save();
        }

        //Toastr notifications
        $notification = array(
            'message' => 'Studnet created', 
            'alert-type' => 'success'
        );
        return redirect('/students/create')->with($notification);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('students.view')->with('student',$student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Send AcademicYear | Course | SpecializedArea | Department details
        $academicYears = $this->findAcademicYears();
        $departments = $this->findDepartments();
        $courses = $this->findCourses();
        $specializedAreas = $this->findSpecializedAreas();


        $student = Student::find($id);

        return view('students.edit')->with(['academicYears' => $academicYears,
        'departments' => $departments,
        'courses' => $courses,
        'specializedAreas' => $specializedAreas, 
        'student' => $student]);
                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find student
        $student = Student::find($id);

         //validation
         $this->validate($request, [

            'student_registration_number' => 'required',
            'student_index_number' => ($student->student_index_number == $request->input('student_index_number')) ? 'required' : 'required|unique:students',
            'department_id' => 'nullable',
            'course_id' => 'required',
            'academic_year_id' => 'required',
            'specialized_area_id' => 'nullable',
            'initials' => 'required',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'nic_number' => ($student->nic_number == $request->input('nic_number') ? 'required|min:10' : 'required|unique:students|min:10'),
            'date_of_birth' => 'required',
            'gender' => 'required',
            'marriage_state' => 'required',
            'email' => ($student->email == $request->input('email') ? 'email|nullable' : 'email|nullable|unique:students'),
            'contact_no_mobile' => 'nullable|min:10',
            'contact_no_home' => 'nullable|min:10',
            'home_address_1' => 'nullable',
            'home_address_2' => 'nullable',
            'home_address_3' => 'nullable',
            'current_address_1' => 'nullable',
            'current_address_2' => 'nullable',
            'current_address_3' => 'nullable',
            'fb_url' => 'nullable',
            'linkedin_url' => 'nullable',
            'father_name' => 'nullable',
            'father_occupation' => 'nullable',
            'mother_name' => 'nullable',
            'mother_occupation' => 'nullable',
            'number_of_sisters_and_brothers' => 'nullable',
            'dissertation_title' => 'nullable',
            'dissertation_published_link' => 'nullable',
            'supervisor_name' => 'nullable',
            'profile_picture' => 'image|nullable|max:1999',
            'bio' => 'nullable',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture')->store('public/avatars');
            $path = str_replace("public/avatars","/storage/avatars",$file);

        } else {
            $path = $request->input('_img_path');
        }
        
        //Config subjects
        //if Course has changed
        if($student->course_id != $request->course_id){

            //Delete old assigned subjects
            //Every year subjects included specialized subjects
            $student_subjects = DB::table('student_subjects')->where([
                                                        ['students_stu_reg_no','=', $student->student_registration_number],
                                                    ])->get();
            //Execute delete
            foreach($student_subjects as $student_subject){
                $subject = StudentSubjects::find($student_subject->assign_id);
                $subject->delete();
            }

            //Insert subjects according to the new course
            //Year 1 & 2
            $subjects = DB::table('subjects')->where([['course_id','=',$request->course_id],
                                                      ['year','=','1'],
                                                     ])
                                            ->orWhere([['course_id','=',$request->course_id],
                                                        ['year','=','2'],
                                                      ])->get();
    
            foreach($subjects as $subject){
                $student_subjects = new StudentSubjects;
                $student_subjects->students_stu_reg_no = $request->student_registration_number;
                $student_subjects->subjects_subject_code = $subject->subject_code;
                $student_subjects->save();
            }

            //Year 3 and Year 4 - Common Subjects
            //Only common subjects ->specilaized_area = Not Specified
            $specialized_area_id = SpecializedArea::where('name','Not Specified')->first()->specialized_area_id;

            $subjects = DB::table('subjects')->where([['course_id','=', $request->course_id],
                                                    ['year','=','3'],
                                                    ['specialized_area_id','=', $specialized_area_id],
                                                    ])
                                        ->orWhere([['course_id','=',$request->course_id],
                                                    ['year','=','4'],
                                                    ['specialized_area_id','=', $specialized_area_id],
                                                    ])->get();

            foreach($subjects as $subject){
                $student_subjects = new StudentSubjects;
                $student_subjects->students_stu_reg_no = $request->student_registration_number;
                $student_subjects->subjects_subject_code = $subject->subject_code;
                $student_subjects->save();
            }
        }
            //End Config Subjects

            
        //Set updated values
        $student->student_index_number = $request->input('student_index_number');
        $student->department_id = $request->input('department_id');
        $student->course_id = $request->input('course_id');
        $student->academic_year_id = $request->input('academic_year_id');
        $student->specialized_area_id = $request->input('specialized_area_id');
        $student->initials = $request->input('initials');
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->nic_number = $request->input('nic_number');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->gender = $request->input('gender');
        $student->marriage_state = $request->input('marriage_state');
        $student->email = $request->input('email');
        $student->contact_no_mobile = $request->input('contact_no_mobile');
        $student->contact_no_home = $request->input('contact_no_home');
        $student->home_address_1 = $request->input('home_address_1');
        $student->home_address_2 = $request->input('home_address_2');
        $student->home_address_3 = $request->input('home_address_3');
        $student->current_address_1 = $request->input('current_address_1');
        $student->current_address_2 = $request->input('current_address_2');
        $student->current_address_3 = $request->input('current_address_3');
        $student->fb_url = $request->input('fb_url');
        $student->linkedin_url = $request->input('linkedin_url');
        $student->father_name = $request->input('father_name');
        $student->father_occupation = $request->input('father_occupation');
        $student->mother_name = $request->input('mother_name');
        $student->mother_occupation = $request->input('mother_occupation');
        $student->number_of_sisters_and_brothers = $request->input('number_of_sisters_and_brothers');
        $student->dissertation_title = $request->input('dissertation_title');
        $student->dissertation_published_link = $request->input('dissertation_published_link');
        $student->supervisor_name = $request->input('supervisor_name');
        $student->profile_picture = $path;
        $student->bio = $request->input('bio');
        //Save updates
        $student->save();

        // Find user
        $user = User::find($id);
        $user->name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->save();

        
        $notification = array(
            'message' => 'Successfully updated', 
            'alert-type' => 'success'
        );

        return redirect('/students')->with($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Remove from students table
        $student = Student::findOrFail($id);
        $student->delete();

        //Remove from user registration
        $user = User::findOrFail($id);
        $user->delete();

        //Remove from subject assigning
        DB::table('student_subjects')->where('students_stu_reg_no', '=', $id)->delete();

        //Remove stored grades
        DB::table('grades')->where('student_registration_number', '=', $id)->delete();

        return response()->json($student);
    }

}
