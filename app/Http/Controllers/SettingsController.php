<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Course;
use App\Department;
use App\Grading;
use App\SpecializedArea;
use App\Student;
use App\StudentSubjects;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('config');
        $this->middleware('auth');
        //Head of the department or Dean can access to followings
        $this->middleware('DeanOrHead');
    }

    public function findAcademicYears()
    {
        return AcademicYear::all();
    }

    public function findSpecializedAreas()
    {
        return SpecializedArea::all();
    }

    public function findGradings()
    {
        return Grading::all();
    }

    public function findCourses()
    {
        return Course::all();
    }

    public function findDepartments()
    {
        return Department::all();
    }

    //Show settings index page
    public function showSettingsPage()
    {
        //Should done by Dean or Head of the Department
        $academicYears = $this->findAcademicYears();
        $gradings = $this->findGradings();
        $specializedAreas = $this->findSpecializedAreas();
        $courses = $this->findCourses();

            return view('settings.index')->with(['academicYears' => $academicYears,
                'gradings' => $gradings,
                'specializedAreas' => $specializedAreas,
                'courses' => $courses]);
        
    }

    //Show Students page according to course and academic year
    public function showStudentsSettingsPage(Request $request)
    {
            $students = Student::where('academic_year_id', $request->academic_year_id)
                ->where('course_id', $request->course_id)
                ->orderBy('student_registration_number', 'asc')
                ->get();

            return view('settings.showStudents')->with(['request' => $request,
                'students' => $students]);
       
    }

    //Show Specializations page
    public function showSpecializationsSettingsPage($id)
    {

            $student = Student::findOrFail($id);
            $departments = $this->findDepartments();
            $specializedAreas = $this->findSpecializedAreas();
            $subjects = Subject::all();
            $student_subjects = StudentSubjects::where('students_stu_reg_no', $id)->get();

            return view('settings.showSpecializations')->with(['student' => $student,
                'departments' => $departments,
                'specializedAreas' => $specializedAreas,
                'subjects' => $subjects,
                'student_subjects' => $student_subjects]);
        
    }

    //Updating with request
    public function config($id, Request $request)
    {

        //Find student with ID
        $student = Student::find($id);
        //Department
        $student->department_id = $request->department_id;
        //Specialized Area
        $student->specialized_area_id = $request->specialized_area_id;
        //Update student
        $student->save();

        //Student_Subjects
        //Manage selected subjects
        for ($i = 0; $i < count($request->subjects); $i++) {
            //If Student_registration_number + Course_code exist >> status == 1
            //Else we have to insert a new row
            $result = DB::table('student_subjects')->where([['subjects_subject_code', '=', $request->subjects[$i]],
                ['students_stu_reg_no', '=', $id],
            ])->get();
            //Insert new row
            if (count($result) == 0) {
                $student_subjects = new StudentSubjects;
                $student_subjects->students_stu_reg_no = $id;
                $student_subjects->subjects_subject_code = $request->subjects[$i];
                $student_subjects->save();
            }
        }

        //Manage unselected subjects
        //Find all subjects stores in DB which related to student

        //Use only specialized subjects. It means without year 1 & 2
        //And without common subjects

        //Get specialized_area_id of Not Specified
        $specialized_area_id = SpecializedArea::where('name','Not Specified')->first()->specialized_area_id;

        $results = DB::table('student_subjects')
        ->join('subjects', 'student_subjects.subjects_subject_code', '=', 'subjects.subject_code')
        ->whereIn('subjects.year', [3, 4])
        ->where([['students_stu_reg_no', '=', $id], ['specialized_area_id','<>', $specialized_area_id],])
        ->get();

        foreach ($results as $result) {

            if($request->subjects){
                if (!in_array($result->subjects_subject_code, $request->subjects)) {
                    $find = StudentSubjects::find($result->assign_id);
                    $find->delete();
                }
            }
            
        }

        //Toastr notifications
        $notification = array(
            'message' => 'Configuration completed',
            'alert-type' => 'success',
        );

        $data = Student::find($id);
        $data2 = new Request;
        $data2->academic_year_id = $data->academic_year_id;
        $data2->course_id = $data->course_id;

        $students = Student::where('academic_year_id', $data->academic_year_id)
            ->where('course_id', $data->course_id)
            ->orderBy('student_registration_number', 'asc')
            ->get();

        return view('settings.showStudents')->with(['request' => $data2,
            'students' => $students,
            'notification' => $notification]);

    }


    // public function test(){
    //     $results = DB::table('student_subjects')
    //     ->join('subjects', 'student_subjects.subjects_subject_code', '=', 'subjects.subject_code')
    //     ->whereIn('subjects.year', [3 , 4 ])
    //     ->where('students_stu_reg_no', '=', '2014c001') 
    //     ->get();

    //     return $results;
    // }
}
