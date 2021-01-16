<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use App\Grading;
use App\AcademicYear;
use App\Subject;
use App\Student;
use App\StudentSubjects;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Excel;
use File;
use Session;
use App\Imports\ImportGrades;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

//Traits
use App\Traits\GPA;
use Illuminate\Notifications\Notifiable;
//Jobs
use App\Jobs\notifyStudentResultsJob;
//Notifications
use App\Notifications\publishResults;

class GradesController extends Controller
{
    //GPA Calculatuion trait
    use GPA;
    //Notifications trait
    use Notifiable;
    
    public function __construct(){
        // Configurations middleware
        $this->middleware('config');
        // Authentication middlewares    
        // function list to attach middleware
        // index                -   AR || Dean || Lectures || Exam_branch
        // publishResults       -   Exam Branch only
        // updateGrades         -   Exam Branch only
        // showStudentsToEdit   -   Exam Branch only
        // showStudentsToStore  -   Exam Branch only
        // store                -   Exam Branch only
        // search               -   AR || Dean || Lectures    
        $this->middleware('auth');
        $this->middleware('examBranchOnly',['except'=> ['search','findSubjects','show','index','calculateGPA','calculateGPASemesterWise','showGPApage']]);
        $this->middleware('ifStudent',['except'=> ['show','calculateGPA','calculateGPASemesterWise','showGPApage' ]]);               
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Search feature
        //Create links
        $academicYears = AcademicYear::all();

        $attentions = DB::table('grades')->select('subject_code','exam_year')->distinct()->where('published','=', false)->get();
        $subjects = Subject::all();
        $examYears = DB::table('grades')->select('exam_year')->distinct()->orderBy('exam_year','desc')->get();
        $gradings = Grading::all();

        return view('grades.index')->with(['academicYears'=> $academicYears,
        'subjects' => $subjects,
        'attentions' => $attentions,
        'examYears' => $examYears,
        'gradings' => $gradings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Not used
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                            
        //Find credit value according to Subject Code
        $credits = Subject::find($request->subject_code)->credits;
        
        // Grades creation
        for ($i = 0; $i < count($request->student_registration_number); $i++) {
            // Create new object
            $grade = new Grade;
            // student_registration_number
            $grade->student_registration_number = $request->student_registration_number[$i];
            // student_index_number
            $grade->student_index_number = $request->student_index_number[$i];
            // subject_code - Not in array
            $grade->subject_code = $request->subject_code;
            // grade
            // ID of grade from grading table
            $grade->grade = $request->grade[$i];
            // exam_year
            $grade->exam_year = $request->exam_year;
            // credits
            $grade->credits = $credits;
            // points_value
            // According to the gradings table with its ID
            $points_value = Grading::find($request->grade[$i])->points;
            $grade->points_value = $points_value;
            // gpv
            // GPV = Credits * Points_Value
            $gpv = $credits * $points_value;
            $grade->gpv = $gpv;
            // published
            // Check publish value
            $grade->published = ($request->publish == true) ? true : false;
           

            //Manage 'repeat'
            //Reg No + Subject Code --> 
            //Find and set 'repeat' as true
            $results = DB::table('grades')
            ->where([
                ['student_registration_number','=',$request->student_registration_number[$i]],
                ['subject_code','=', $request->subject_code], ])
            ->get();
            //
            foreach($results as $result){
                $find = Grade::find($result->id);
                $find->repeat = true;
                $find->save();
            }
            //
            //set repeat value for current student
            if(count($results) == 0){
                //repeat -> false
                $grade->repeat = false;
            }else{
                //repeat -> true
                $grade->repeat = true;
            }

            //Save
            $grade->save();

             //Send Email to notify student if publish is true
            //Find email & Namefrom Student student_registration_number
            //Add to Job
            //Check for null email address
            if($request->publish == true){

                $students =  DB::table('grades')
                ->join('students', 'students.student_registration_number', '=', 'grades.student_registration_number')
                ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                ->where([['grades.subject_code','=', $request->subject_code],['grades.exam_year','=',$request->exam_year], ['grades.student_registration_number','=', $request->student_registration_number[$i]], ])
                ->select('grades.student_index_number','students.email' ,'grades.student_registration_number', 'students.first_name' , 'grades.exam_year', 'grades.subject_code' , 'subjects.title')
                ->get();

                foreach($students as $student){
                    //Check for null email address
                    if($student->email != ''){
                        notifyStudentResultsJob::dispatch($student);
                    }
                }

                //Notifications 
                //Created for each user
                $user = User::find($student->student_registration_number);
                $user->notify(new publishResults($student->title , $student->subject_code ,$student->exam_year ));

            }
            
        }

        if ((count($request->student_registration_number)) != 1) {

            if($request->publish == true){
                $msg = "Results were added and published for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }else{
                $msg = "Results were added for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }
            
        } else {

            if($request->publish == true){
                $msg = "Result was added and published for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }else{
                $msg = "Result was added for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }
        }

        $notification = array(
            'message' => $msg, 
            'alert-type' => 'success'
        );

        return redirect('/grades')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        //Show individual student results
        //grades/show/id
        //From search results
        //Manage student results with GPA calculations

        //Student details
        $student = Student::find($id);

        //Gradings details
        $gradings = Grading::all();

        //Results
        //Year 1 - Semester 1
        //Where --> Grades.student_registration_number = $id
        //Where --> Grades.published = true
        //Where --> Subjects.year = 1 .semester = 1
        $year1_sem1 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '1'],
                            ['subjects.semester','=', '1'],
                            ])
                    ->select('grades.*')
                    ->get();
        
        //Year 1 - Semester 2
        $year1_sem2 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '1'],
                            ['subjects.semester','=', '2'],
                            ])
                    ->select('grades.*')
                    ->get();

        //Year 2 - Semester 1
        $year2_sem1 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '2'],
                            ['subjects.semester','=', '1'],
                            ])
                    ->select('grades.*')
                    ->get();

        //Year 2 - Semester 2
        $year2_sem2 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '2'],
                            ['subjects.semester','=', '2'],
                            ])
                    ->select('grades.*')
                    ->get();

        //Year 3 - Semester 1
        $year3_sem1 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '3'],
                            ['subjects.semester','=', '1'],
                            ])
                    ->select('grades.*')
                    ->get();

        //Year 3 - Semester 2
        $year3_sem2 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '3'],
                            ['subjects.semester','=', '2'],
                            ])
                    ->select('grades.*')
                    ->get();

        //Year 4 - Semester 1
        $year4_sem1 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '4'],
                            ['subjects.semester','=', '1'],
                            ])
                    ->select('grades.*')
                    ->get();

        //Year 4 - Semester 2
        $year4_sem2 = DB::table('grades')
                    ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                    ->where([['grades.published','=',true],
                            ['grades.student_registration_number','=',$id],
                            ['subjects.year','=', '4'],
                            ['subjects.semester','=', '2'],
                            ])
                    ->select('grades.*')
                    ->get();


        //GPA calculation
        $GPA = $this->calculateGPA($id);

        
        //Manage logged user is a student
        if(Auth::user()->type == 'student'){
            if($id == Auth::user()->user_name){

                //Make all notifications as read
                foreach (Auth::user()->unreadNotifications as $notification) {
                    $notification->markAsRead();
                }

                //Authorized to show student profile for logged student user
                return view('grades.show')->with(['student' => $student,
                'gradings' => $gradings,
                'year1_sem1' => $year1_sem1,
                'year1_sem2' => $year1_sem2,
                'year2_sem1' => $year2_sem1,
                'year2_sem2' => $year2_sem2,
                'year3_sem1' => $year3_sem1,
                'year3_sem2' => $year3_sem2,
                'year4_sem1' => $year4_sem1,
                'year4_sem2' => $year4_sem2,
                'GPA' => $GPA,
                ]);
                
            }else{
                return redirect()->back()->with('error','Unauthorized page.');
            }    
        }

        return view('grades.show')->with(['student' => $student,
        'gradings' => $gradings,
        'year1_sem1' => $year1_sem1,
        'year1_sem2' => $year1_sem2,
        'year2_sem1' => $year2_sem1,
        'year2_sem2' => $year2_sem2,
        'year3_sem1' => $year3_sem1,
        'year3_sem2' => $year3_sem2,
        'year4_sem1' => $year4_sem1,
        'year4_sem2' => $year4_sem2,
        'GPA' => $GPA,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //not used
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
        //Not used
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Not used
    }

    //Handle search
    public function search(Request $request)
    {
        $hint = '';
        switch($request->search_hint){
            case '1':
                //student_registration_number
                $students = Student::where('student_registration_number','=',$request->student_registration_number)->get();
                $hint = 'Registration Number: '. $request->student_registration_number;
                break;
            case '2':
                //student_index_number
                $students = Student::where('student_index_number','=',$request->student_index_number)->get();
                $hint = 'Index Number: '. $request->student_index_number;
                break;
            case '3':
                //subject_code
                //academic_year_id   
                //Show subject results -> According to the subject

                $year = AcademicYear::find($request->academic_year_id);
                $hint = 'Subject Code: '. $request->subject_code . ' in Academic Year: '. $year->year;

                //Should return view for showing student detatils with grade
                $students = DB::table('students')
                            ->join('grades', 'students.student_registration_number', '=', 'grades.student_registration_number')
                            ->where([['students.academic_year_id','=',$request->academic_year_id],
                                    ['grades.subject_code','=', $request->subject_code],])
                            ->select('students.*','grades.grade','grades.exam_year')
                            ->get();

                // $students = Grade::where('subject_code','=',$request->subject_code)->get();
                return view('grades.search_subject')->with(['students' => $students, 'hint' => $hint]);
                break;

            default:
                //first_name
                //last_name
                $students = DB::table('students')
                    ->where('first_name', 'like', $request->first_name)                 
                    ->where('first_name', 'like', ($request->first_name == null)? '' : $request->first_name )
                    ->orWhere('last_name', 'like', ($request->last_name == null)? '' : $request->last_name)
                    ->get();
                $hint = 'First Name: '. $request->first_name . ' Last Name: '. $request->last_name;
                

        }
        
        //Show search results page
        //Send showing results for : inputs
        return view('grades.search')->with(['students' => $students,
        'hint'=>$hint]);
    }

    //Provide relevent subjects
    public function findSubjects(Request $request){
        $subjects = Subject::where('course_id','=',$request->course_id)->get();
        return response()->json($subjects);
    }

    //Handle showing students to add results
    public function showStudentsToStore(Request $request){
         $students = DB::table('students')
                            ->join('student_subjects', 'student_subjects.students_stu_reg_no', '=', 'students.student_registration_number')
                            ->where([['students.academic_year_id','=',$request->academic_year_id],
                                     ['student_subjects.subjects_subject_code','=', $request->subject],
                                    ])
                            ->select('students.*')
                            ->get();

        $subject_code = $request->subject;
        $subject_title = Subject::find($request->subject)->title; 
        $academic_year = AcademicYear::find($request->academic_year_id)->year;
        $gradings = Grading::all();

        return view('grades.create')->with(['students' => $students,
                                          'subject_code' => $subject_code,
                                          'subject_title'=> $subject_title,
                                          'academic_year' => $academic_year,
                                          'academic_year_id' => $request->academic_year_id,
                                          'gradings' => $gradings]);

    }

    //Handle edit function
    public function showStudentsToEdit(Request $request){
        //Return results from grades table
        // subject
        // exam_year

        $grades = DB::table('grades')->where([ ['subject_code','=',$request->subject],
        ['exam_year','=',$request->exam_year],
        ])->get();
        
        $subject_code = $request->subject;
        $subject_title = Subject::find($request->subject)->title; 
        $gradings = Grading::all();

        return view('grades.edit')->with(['subject_code'=> $subject_code,
        'subject_title' => $subject_title,
        'grades' => $grades,
        'exam_year' => $request->exam_year,
        'gradings' => $gradings,
        ]);
    }

    public function updateGrades(Request $request){  
        
        // publish state false - > only update nothing change in updated value
        // publish state true  - > Update published as true with other values

        //Find credit value of subject
        $credits = Subject::find($request->subject_code)->credits;

        // Grades creation
        for ($i = 0; $i < count($request->id); $i++) {
            // Create new object
            $grade = Grade::find($request->id[$i]);
            
            // ID of grade from grading table
            $grade->grade = $request->grade[$i];

            // exam_year
            $grade->exam_year = $request->exam_year[$i];
                    
            // points_value
            // According to the gradings table with its ID
            $points_value = Grading::find($request->grade[$i])->points;
            $grade->points_value = $points_value;

            // gpv
            // GPV = Credits * Points_Value
            $gpv = $credits * $points_value;
            $grade->gpv = $gpv;

            // published
            // Check publish value
            $grade->published = ($request->publish == true) ? true : false;

            //Send Email to notify student if publish is true
            //Find email from Student student_registration_number
            //Add to Job
            if($request->publish == true){
                
                $students =  DB::table('grades')
                ->join('students', 'students.student_registration_number', '=', 'grades.student_registration_number')
                ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                ->where([['grades.subject_code','=', $request->subject_code],['grades.exam_year','=',$request->exam_year[$i]], ['grades.student_registration_number','=',$request->student_registration_number[$i]] ])
                ->select('grades.student_index_number','students.email' ,'grades.student_registration_number', 'students.first_name' , 'grades.exam_year', 'grades.subject_code' , 'subjects.title')
                ->get();

                foreach($students as $student){
                    //Check for null email address
                    if($student->email != ''){
                        notifyStudentResultsJob::dispatch($student);
                    }

                    //Notifications 
                    //Created for each user
                    $user = User::find($student->student_registration_number);
                    $user->notify(new publishResults($student->title , $student->subject_code ,$student->exam_year ));

                }
                
            }
            

            $grade->save();
        }

        if ((count($request->student_registration_number)) != 1) {

            if($request->publish == true){
                $msg = "Results were updated and published for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }else{
                $msg = "Results were updated for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }
            
        } else {

            if($request->publish == true){
                $msg = "Result was updated and published for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }else{
                $msg = "Result was updated for the subject : ". $request->subject_code .' - ' .$request->subject_title;
            }
        }

        $notification = array(
            'message' => $msg, 
            'alert-type' => 'success'
        );

        return redirect('/grades')->with($notification);
        
    }

    //Publish results - from publish results panel
    public function publishResults(Request $request){
        $status =  DB::table('grades')
            ->where([['subject_code','=', $request->subject_code],['exam_year','=',$request->exam_year]])
            ->update(['published' => true]);
        
        //Send email to students
        //Find students
        $students =  DB::table('grades')
            ->join('students', 'students.student_registration_number', '=', 'grades.student_registration_number')
            ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
            ->where([['grades.subject_code','=', $request->subject_code],['grades.exam_year','=',$request->exam_year], ])
            ->select('grades.student_index_number','students.email' ,'grades.student_registration_number', 'students.first_name' , 'grades.exam_year', 'grades.subject_code' , 'subjects.title')
            ->get();

        //Notification data

        foreach($students as $student){
            //Check for null email address
            if($student->email != ''){
                notifyStudentResultsJob::dispatch($student);
            }

            //Notifications 
            //Created for each user
            $user = User::find($student->student_registration_number);
            $user->notify(new publishResults($student->title , $student->subject_code ,$student->exam_year ));
        }
        
        return response()->json($status);
    }

    public function showGPApage(){

        $id = Auth::user()->user_name;

        //Year 1 - Semester 1
        $year1Semester1 =  $this->calculateGPASemesterWise($id, '1', '1');
        //Year 1 - Semester 2
        $year1Semester2 =  $this->calculateGPASemesterWise($id, '1', '2');

        //Year 2 - Semester 1
        $year2Semester1 =  $this->calculateGPASemesterWise($id, '2', '1');
        //Year 2 - Semester 2
        $year2Semester2 =  $this->calculateGPASemesterWise($id, '2', '2');

        //Year 3 - Semester 1
        $year3Semester1 =  $this->calculateGPASemesterWise($id, '3', '1');
        //Year 3 - Semester 2
        $year3Semester2 =  $this->calculateGPASemesterWise($id, '3', '2');

        //Year 4 - Semester 1
        $year4Semester1 =  $this->calculateGPASemesterWise($id, '4', '1');
        //Year 4 - Semester 2
        $year4Semester2 =  $this->calculateGPASemesterWise($id, '4', '2');

        //get overall GPA
        $gpa = $this->calculateGPA($id);

        return view('grades.gpa')->with([
        'year1Semester1' => $year1Semester1,
        'year1Semester2' => $year1Semester2,

        'year2Semester1' => $year2Semester1,
        'year2Semester2' => $year2Semester2,

        'year3Semester1' => $year3Semester1,
        'year3Semester2' => $year3Semester2,

        'year4Semester1' => $year4Semester1,
        'year4Semester2' => $year4Semester2,

        'GPA'            => $gpa,
        ]);

    }

    public function addRepeatSubjectResults(Request $request){

        //Check the availability of subject_code in 'Students_subject' table
        //With stu reg no + subject_code
        //Return warining if doesnt -> The student doesnt have permission to sit for that subject :-(
            $subject_title = Subject::find($request->subject_code)->title;

            $avalability = StudentSubjects::where([
                ['students_stu_reg_no', $request->student_registration_number],
                ['subjects_subject_code' ,$request->subject_code],
            ])
            ->get();

            if(count($avalability) == 0){
                $notification = array(
                    'message' => "The student didn't enrolled with this subject: " . $request->subject_code . " - " .  $subject_title, 
                    'alert-type' => 'warning'
                );
        
                return redirect('/grades')->with($notification);
            }
            
            //Find credit value according to Subject Code
            $credits = Subject::find($request->subject_code)->credits;
            
            // Grades creation

            // Create new object
            $grade = new Grade;
            // student_registration_number
            $grade->student_registration_number = $request->student_registration_number;
            // student_index_number
            $grade->student_index_number = Student::find($request->student_registration_number)->student_index_number;
            // subject_code - Not in array
            $grade->subject_code = $request->subject_code;
            // grade
            // ID of grade from grading table
            $grade->grade = $request->grade;
            // exam_year
            $grade->exam_year = $request->exam_year;
            // credits
            $grade->credits = $credits;
            // points_value
            // According to the gradings table with its ID
            $points_value = Grading::find($request->grade)->points;
            $grade->points_value = $points_value;
            // gpv
            // GPV = Credits * Points_Value
            $gpv = $credits * $points_value;
            $grade->gpv = $gpv;
            // published
            // Check publish value
            $grade->published = ($request->publish == true) ? true : false;
           

            //Manage 'repeat'
            //Reg No + Subject Code --> 
            //Find and set 'repeat' as true
            $results = DB::table('grades')
            ->where([
                ['student_registration_number','=',$request->student_registration_number],
                ['subject_code','=', $request->subject_code], ])
            ->get();
            //
            foreach($results as $result){
                $find = Grade::find($result->id);
                $find->repeat = true;
                $find->save();
            }
            //
            //set repeat value for current student
            if(count($results) == 0){
                //repeat -> false
                $grade->repeat = false;
            }else{
                //repeat -> true
                $grade->repeat = true;
            }

            //Save
            $grade->save();

             //Send Email to notify student if publish is true
            //Find email & Namefrom Student student_registration_number
            //Add to Job
            //Check for null email address
            if($request->publish == true){

                $students =  DB::table('grades')
                ->join('students', 'students.student_registration_number', '=', 'grades.student_registration_number')
                ->join('subjects', 'grades.subject_code', '=', 'subjects.subject_code')
                ->where([['grades.subject_code','=', $request->subject_code],['grades.exam_year','=',$request->exam_year], ['grades.student_registration_number','=', $request->student_registration_number], ])
                ->select('grades.student_index_number','students.email' ,'grades.student_registration_number', 'students.first_name' , 'grades.exam_year', 'grades.subject_code' , 'subjects.title')
                ->get();

                foreach($students as $student){
                    //Check for null email address
                    if($student->email != ''){
                        notifyStudentResultsJob::dispatch($student);
                    }
                }

                //Notifications 
                //Created for each user
                $user = User::find($student->student_registration_number);
                $user->notify(new publishResults($student->title , $student->subject_code ,$student->exam_year ));

            }
            
            if($request->publish == true){
                $msg = "Result was added and published for the subject : ". $request->subject_code .' - ' .$subject_title;
            }else{
                $msg = "Result was added for the subject : ". $request->subject_code .' - ' .$subject_title;
            }
        

        $notification = array(
            'message' => $msg, 
            'alert-type' => 'success'
        );

        return redirect('/grades')->with($notification);
    }


    //Handle importing from excel file
    public function importGrades(Request $request){

        // //Validation
        $this->validate($request, array(
            'file'  => 'required',
            'academic_year_id' => 'required',
            'subject' => 'required'
        ));

        if($request->hasFile('file')){

            //Get the file extension
            $extension = File::extension($request->file->getClientOriginalName());

            //Use only excel file
            if ($extension == "xlsx" || $extension == "xls") {
                
                //Load excel data into array
                $data = Excel::toArray(new ImportGrades, $request->file('file'));

                //Check the file data
                if(!empty($data)){

                    //Update 'grade_id' instead of 'grade'
                    for($i = 0; count($data[0]) > $i ; $i++){

                        if($i == 0){
                            //To skip heading row
                            continue;
                        }

                        //$i will be loop throught data
                        //1 is the Grade column
                        $id = DB::table('gradings')
                        ->where('grade', $data[0][$i][1] )
                        ->first();
                                                  
                        $data[0][$i][1] = $id->id;
                                    
                    }


                    //Student details alone with academic year
                    $students = DB::table('students')
                    ->join('student_subjects', 'student_subjects.students_stu_reg_no', '=', 'students.student_registration_number')
                    ->where([['students.academic_year_id','=',$request->academic_year_id],
                             ['student_subjects.subjects_subject_code','=', $request->subject],
                            ])
                    ->select('student_registration_number',
                    'student_index_number',
                    'academic_year_id',
                    'first_name',
                    'last_name',
                    'course_id',
                    'department_id')
                    ->get();

                    //Loop through the students object
                    foreach($students as $student){

                        for($i = 0; count($data[0]) > $i ; $i++){

                            if($i == 0){
                                //To skip heading row
                                continue;
                            }
    
                            //$i will be loop throught data                            
                                                      
                            if($data[0][$i][0] == $student->student_registration_number){
                                $student->grade_id = $data[0][$i][1];
                                break;
                            }
                                        
                        }
                    }


                    $subject_code = $request->subject;
                    $subject_title = Subject::find($request->subject)->title; 
                    $academic_year = AcademicYear::find($request->academic_year_id)->year;
                    $gradings = Grading::all();
                    $hint = "import";

                    return view('grades.create')->with(['students' => $students,
                                                    'subject_code' => $subject_code,
                                                    'subject_title'=> $subject_title,
                                                    'academic_year' => $academic_year,
                                                    'academic_year_id' => $request->academic_year_id,
                                                    'gradings' => $gradings,
                                                    'hint' => $hint]);                    

                                       
                }
 
                Session::flash('warning', 'Uploaded file is empty. Please try again with correct file.');
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file. Please upload a valid excel file.');
                return back();
            }
        }

        // return $request->all();
    }



}
