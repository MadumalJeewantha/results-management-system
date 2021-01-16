<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\AcademicYear;
use App\Course;
use App\Department; 
use App\SpecializedArea;
use App\Student;
use App\Lecture;
use App\User;
use App\Subject;
use App\StudentSubjects;
use App\LectureSubject;
use App\Grading;
use App\Grade;
use Illuminate\Support\Facades\DB;

//Excel export
use App\Exports\studentsExcelExport;
use App\Exports\assignedSubjectsOfStudentExcelExport;
use App\Exports\lecturesExcelExport;
use App\Exports\assignedSubjectsOfSpecificLectureExcelExport;
use App\Exports\subjectResultsExcelExport;
use App\Exports\courseDetailsExcelExport;
use App\Exports\gradingSystemExcelExport;
use App\Exports\semesterResultsExcelExport;

use Maatwebsite\Excel\Facades\Excel;

use App\Traits\GPA;


class ReportsController extends Controller
{
    use GPA;

    public function __construct()
    {
        $this->middleware('config');
        $this->middleware('auth');
        // Students dont have access to the reports section
        $this->middleware('ifStudent',['except'=> ['fullResultsOfSpecificStudent'] ]);

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {        
         
        return view('reports.index')->with(['academicYears'=> $this->findAcademicYears(),
        'courses' => $this->findCourses(),
        'departments' => $this->findDepartments(),
        'specializedAreas' => $this->findSpecializedAreas(),
        'subjects' => $this->findSubjects(),
        'examYears' => $this->findExamYears(),
        ]);
    }

    public function findAcademicYears()
    {        
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

    public function findSubjects(){
        return Subject::all();
    }

    public function findExamYears(){
        return $examYears = DB::table('grades')->select('exam_year')->distinct()->orderBy('exam_year','desc')->get();
    }

    //Students
    public function studentsInSpecificAcademicYear(Request $request){
        //Inputs
        //academic_year_id
        //columns[]
        //export_type

        
        $students = Student::where('academic_year_id','=',$request->academic_year_id)->get();
        $academicYear = AcademicYear::find($request->academic_year_id)->year;            
        $columns = $request->columns;

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.studentsInSpecificAcademicYear', compact('students','columns','academicYear'))->setPaper('a4', $orientation);
            return $pdf->download('students '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new studentsExcelExport($students , $columns), 'students '. date("y:m:d h:i:s a") . '.xlsx');            
        }


    }

    public function studentsInSpecificCourse(Request $request){
        //inputs
        //academic_year_id
        //course_id
        //columns

        $students = Student::where([['academic_year_id','=',$request->academic_year_id],['course_id','=', $request->course_id]])->get();
        $academicYear = AcademicYear::find($request->academic_year_id)->year;
        $course = Course::find($request->course_id)->name;
        
        $columns = $request->columns;

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.studentsInSpecificCourse', compact('students','columns','academicYear','course'))->setPaper('a4', $orientation);
            return $pdf->download('students '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new studentsExcelExport($students , $columns), 'students '. date("y:m:d h:i:s a") . '.xlsx');            
        }


    }

    public function studentsInSpecificDepartment(Request $request){
        //inputs
        //academic_year_id
        //department_id
        //columns

        $students = Student::where([['academic_year_id','=',$request->academic_year_id],['department_id','=', $request->department_id]])->get();
        $academicYear = AcademicYear::find($request->academic_year_id)->year;
        $department = Department::find($request->department_id)->name;
        
        $columns = $request->columns;

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.studentsInSpecificDepartment', compact('students','columns','academicYear','department'))->setPaper('a4', $orientation);
            return $pdf->download('students '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new studentsExcelExport($students , $columns), 'students '. date("y:m:d h:i:s a") . '.xlsx');            
        }
    }

    public function studentsInSpecificSpecializedArea(Request $request){
        //inputs
        //academic_year_id
        //specialized_area_id
        //columns

        $students = Student::where([['academic_year_id','=',$request->academic_year_id],['specialized_area_id','=', $request->specialized_area_id]])->get();
        $academicYear = AcademicYear::find($request->academic_year_id)->year;
        $specializedArea = SpecializedArea::find($request->specialized_area_id)->name;
        
        $columns = $request->columns;

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.studentsInSpecificSpecializedArea', compact('students','columns','academicYear','specializedArea'))->setPaper('a4', $orientation);
            return $pdf->download('students '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new studentsExcelExport($students , $columns), 'students '. date("y:m:d h:i:s a") . '.xlsx');            
        }

    }

    public function fullDetailsOfStudent(Request $request){
        //inputs
        //student_registration_number
        //columns

        $students = Student::where('student_registration_number','=',$request->student_registration_number)->get();

        $student_registration_number = $request->student_registration_number;
        $columns = $request->columns;

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.fullDetailsOfStudent', compact('students','columns','student_registration_number'))->setPaper('a4', $orientation);
            return $pdf->download('students '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new studentsExcelExport($students , $columns), 'students '. date("y:m:d h:i:s a") . '.xlsx');            
        }
    }

    public function assignedSubjectsOfStudent(Request $request){
        //inputs
        //student_registration_number
        //columns

        $studentSubjects = StudentSubjects::where('students_stu_reg_no','=', $request->student_registration_number)->get();
        $student = Student::find($request->student_registration_number);
        $subjects = Subject::where('course_id','=',$student->course_id)->get();

        $specialized_area_id = $student->specialized_area_id;
        $common_subjects_id = SpecializedArea::where('name','Not Specified')->first()->specialized_area_id;
       
        $columns = $request->columns;

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.assignedSubjectsOfStudent', compact('studentSubjects', 'student' ,'subjects','columns','common_subjects_id'))->setPaper('a4', $orientation);
            return $pdf->download($request->student_registration_number . date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new assignedSubjectsOfStudentExcelExport($student, $studentSubjects , $subjects , $columns ,$common_subjects_id), $request->student_registration_number . date("y:m:d h:i:s a") . '.xlsx');            
        }
    }

    //Lectures
    public function allLecturesInFaculty(Request $request){
        //inputs
        //columns

        $lectures = Lecture::all();

        $columns = $request->columns;

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.allLecturesInFaculty', compact('lectures','columns'))->setPaper('a4', $orientation);
            return $pdf->download('lectures '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new lecturesExcelExport($lectures , $columns), 'lectures '. date("y:m:d h:i:s a") . '.xlsx');            
        }
    }

    public function lecturesInSpecificDepartment(Request $request){
        //inputs
        //columns
        //department_id

        $lectures = Lecture::where('department_id','=', $request->department_id)->get();

        $columns = $request->columns;
        $department = Department::find($request->department_id)->name;        

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.lecturesInSpecificDepartment', compact('lectures','columns','department'))->setPaper('a4', $orientation);
            return $pdf->download('lectures '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new lecturesExcelExport($lectures , $columns), 'lectures '. date("y:m:d h:i:s a") . '.xlsx');            
        }
    }

    public function assignedSubjectsOfSpecificLecture(Request $request){
        //Inputs
        //academic_year_id
        //employee_id
        //columns

        $subjects = DB::table('lecture_subjects')
        ->join('subjects','lecture_subjects.subjects_subject_code','=','subjects.subject_code')
        ->where([['lecture_subjects.lectures_emp_id','=',$request->employee_id], ['lecture_subjects.academic_year_id','=',$request->academic_year_id], ['lecture_subjects.lectures_emp_id','=',$request->employee_id], ])
        ->select('subjects.*')
        ->get();

        $academicYear = AcademicYear::find($request->academic_year_id)->year;
        $lecture = Lecture::find($request->employee_id);

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.assignedSubjectsOfSpecificLecture', compact('subjects', 'lecture'))->setPaper('a4', $orientation);
            return $pdf->download('students '. date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new assignedSubjectsOfSpecificLectureExcelExport($subjects), 'students '. date("y:m:d h:i:s a") . '.xlsx');            
        }
    }

    //Results
    public function fullResultsOfSpecificStudent(Request $request){
        $id = $request->student_registration_number;

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


        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.fullResultsOfSpecificStudent', compact('student','gradings', 'year1_sem1','year1_sem2','year2_sem1' ,'year2_sem2' ,'year3_sem1' ,'year3_sem2' ,'year4_sem1','year4_sem2' , 'GPA'))->setPaper('a4', $orientation);
            return $pdf->download( $id . ' '. date("y:m:d h:i:s a") . '.pdf');

        }
    }

    public function subjectResults(Request $request){
        //inputs
        // subject_code	
        // exam_year	
        // export_type	

        //Grades table

        $grades = Grade::where([['subject_code','=', $request->subject_code],['exam_year','=',$request->exam_year],['published','=', true]])->get();

        $subject_title = Subject::find($request->subject_code)->title;
        $subject_code = $request->subject_code;
        $exam_year = $request->exam_year;
        $credits = Subject::find($request->subject_code)->credits;   

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.subjectResults', compact('grades','subject_title','subject_code','exam_year','credits'))->setPaper('a4', $orientation);
            return $pdf->download($subject_code .'-' . $exam_year . ' ' . date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new subjectResultsExcelExport($grades), $subject_code .'-'. $exam_year. ' '. date("y:m:d h:i:s a") . '.xlsx');            
        }

    }

    public function semesterResults(Request $request){
        //inputs
        // exam_year	"2013"
        // course_id	"1"
        // year	"1"
        // semester	"1"
        // export_type	"pdf"

        //find subjects ->Where: Year-> Semester-> couesr->
        //Then loop through each subject and get grades

        $grades = array();

        //Get the all students in grades
        //conditions -> exam_year | published = true  | Course 
        $students = DB::table('grades')
        ->join('students', 'students.student_registration_number', '=', 'grades.student_registration_number')
        ->where([ 
                    ['grades.exam_year','=', $request->exam_year ], 
                    ['grades.published' ,'=', true], 
                    ['students.course_id' ,'=',$request->course_id],
            ])
        ->select('grades.student_registration_number')
        ->distinct('grades.student_registration_number')
        ->orderBy('grades.student_registration_number','ASC')
        ->get();

        //Subjects
        $subjects = Subject::where([['course_id','=',$request->course_id],
        ['year','=',$request->year],
        ['semester','=',$request->semester],
        ])
        ->get()
        ->toArray();

        //Manage student count
        $j = 0;
        foreach($students as $student){
            for($i = 0; count($subjects) > $i; $i++){

                $grades[$j][$i] = Grade::where([ ['student_registration_number','=', $student->student_registration_number], ['exam_year','=',$request->exam_year], ['subject_code','=', $subjects[$i]['subject_code'] ], ['published' ,'=', true], ])
                ->get()
                ->toArray();

            }

            //Manage count on student
            $j++;
        }


        $course = Course::find($request->course_id)->name;
        $exam_year = $request->exam_year;
        $year = $request->year;
        $semester = $request->semester;
        
        if(count($grades) == 0){

            $notification = array(
                'message' => 'No results found', 
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if($request->export_type == "pdf"){
            //page orientation
            $pdf = PDF::loadView('reports.pdf.semesterResults', compact('subjects','grades','course','exam_year','year','semester'))->setPaper('a4', 'portrait');
            return $pdf->download('Semester Results' . date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new semesterResultsExcelExport($subjects, $grades),  'Semester Results '. date("y:m:d h:i:s a") . '.xlsx');            
        }

        
    }

    //Courses
    public function courseDetails(Request $request){
        //inputs
        //course_id

        //Send
        //subjects
        //specializedAreas

        $subjects = Subject::where('course_id','=', $request->course_id)->get();
        $specializedAreas = SpecializedArea::all();

        $course_name = Course::find($request->course_id)->name;   

        if($request->export_type == "pdf"){
            //page orientation
            $orientation = (count($request->columns) <= 4) ? 'portrait' : 'landscape';

            $pdf = PDF::loadView('reports.pdf.courseDetails', compact('subjects','course_name','specializedAreas'))->setPaper('a4', $orientation);
            return $pdf->download($course_name . ' ' . date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new courseDetailsExcelExport($subjects,$specializedAreas), $course_name . ' '. date("y:m:d h:i:s a") . '.xlsx');            
        }

    }

    //Grading
    public function gradingSystem(Request $request){
        $gradings = Grading::all();

        if($request->export_type == "pdf"){
            //page orientation
            $pdf = PDF::loadView('reports.pdf.gradingSystem', compact('gradings'))->setPaper('a4', 'portrait');
            return $pdf->download('Gradings' . date("y:m:d h:i:s a") . '.pdf');

        }elseif($request->export_type == "excel"){
            return Excel::download(new gradingSystemExcelExport($gradings),  'Gradings '. date("y:m:d h:i:s a") . '.xlsx');            
        }
    }
}
