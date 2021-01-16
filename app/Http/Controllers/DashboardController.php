<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Subject;
use App\AcademicYear;
use App\Grading;
use App\Contact;
use App\Department;
use App\SpecializedArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Traits\GPA;

class DashboardController extends Controller
{
    //GPA Trait
    use GPA;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('config');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

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

    public function index()
    {
        //Provide correct dashboard according to user type
        $type = Auth::user()->type;

        if ($type == 'dean') {

            //2.AR user creation
            $ar = User::where('type', 'ar')->get();
            if ($ar->isEmpty()) {
                return view('config.ar_profile_create');
            }

            //3.Examination branch profile creation
            $examination_branch = User::where('type', 'examination_branch')->get();
            if ($examination_branch->isEmpty()) {
                return view('config.examination_branch_profile_create');
            }

            //4.Course creation
            $course = Course::all();
            if ($course->isEmpty()) {
                return view('config.course_create');
            }

            //5.Department creation
            $department = DB::table('departments')->where('name', '!=', 'Not Specified')->get();
            if ($department->isEmpty()) {
                return view('config.department_create');
            }

            //6.Specialized Areas creation
            $specializedArea = DB::table('specialized_areas')->where('name', '!=', 'Not Specified')->get();
            if ($specializedArea->isEmpty()) {
                return view('config.specialized_area_create');
            }

            //7.Subjects creation
            //Assign Subjects to course
            //Assign subjects to departments
            $subject = Subject::all();
            if ($subject->isEmpty()) {

                //Send Course | SpecializedArea | Department details
                $departments = $this->findDepartments();
                $courses = $this->findCourses();
                $specializedAreas = $this->findSpecializedAreas();

                //route for subjects creation
                return view('config.subject_create')->with([
                'departments' => $departments,
                'courses' => $courses,
                'specializedAreas' => $specializedAreas]);  

            }

            //8.Grading system creation
            $gradings = Grading::all();
            if (count($gradings) == 3) {
                //MC | AB | DFR - Default values
                return view('config.grading_create');
            }

            
            //9.Academic Years creation
            $academicYear = AcademicYear::all();
            if ($academicYear->isEmpty()) {
                return view('config.academic_years_create');
            }

            //10.Lecture creation | skip
            //11.Assign lectures to subjects | skip

            //12.Students creation | skip
            //13.Assign students to subjects | skip
           
            return view('dean.dashboard')->with('studentsPopulation' , $this->studentsPopulation());

        } elseif ($type == 'ar') {

            return view('ar.dashboard');

        } elseif ($type == 'lecture') {

            return view('lectures.dashboard');

        } elseif ($type == 'student') {           
            //Send GPA
            //calculateGPA($id) function
            return view('students.dashboard')
            ->with(['gpa'=> $this->calculateGPA(Auth::user()->user_name),
            'progress' => $this->progressChart(), ]);

        } elseif ($type == 'examination_branch') {
        $attentions = DB::table('grades')->select('subject_code','exam_year')->distinct()->where('published','=', false)->get();
            return view('exam_branch.dashboard')->with('attentions',count($attentions));

        }

    }

    public function progressChart(){

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

        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 100])
        ->labels(['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8'])
        ->datasets([
            [
                "label" => "Grade Point Average (GPA)",
                'backgroundColor' => ($gpa < 2.0) ? "rgba(255, 99, 132, 0.2)" : "rgba(38, 185, 154, 0.7)",
                'borderColor' => ($gpa < 2.0) ? "rgba(255, 99, 132, 0.2)" : "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => ($gpa < 2.0) ? "rgba(255, 99, 132, 0.2)" : "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => ($gpa < 2.0) ? "rgba(255, 99, 132, 0.2)" : "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => ($gpa < 2.0) ? "rgba(255, 99, 132, 0.2)" : "rgba(38, 185, 154, 0.7)",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$year1Semester1, $year1Semester2, $year2Semester1, $year2Semester2, $year3Semester1, $year3Semester2, $year4Semester1, $year4Semester2],
            ],
            
        ])
        ->options([]);
        return $chartjs;
    }

    public function studentsPopulation(){

        $students = DB::select("select count(student_registration_number) as count,academic_year_id from students group by academic_year_id");
        
        $labels = array();
        $data = array();

        $i = 0;
        foreach ($students as $student) {
           $labels[$i] = AcademicYear::find($student->academic_year_id)->year;
           $data[$i] = $student->count; 
           $i++;
        }

        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 100])
        ->labels( $labels)
        ->datasets([
            [
                "label" => "Students Population",
                'backgroundColor' => "rgba(38, 185, 154, 0.7)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                "fill" => true,
                'data' => $data,
            ],
            
        ])
        ->options([]);
        return $chartjs;
    }

}
