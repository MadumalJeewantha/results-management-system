<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Lecture;
use App\LectureSubject;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Response;
use View;

use Validator;
use Illuminate\Support\Facades\Input;

class Lecture_SubjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('config');
        $this->middleware('auth');
        //Head of the department or Dean can access to followings
        $this->middleware('DeanOrHead');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectures = Lecture::all();
        return view('settings.showLectures')->with('lectures', $lectures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        
        $result = DB::table('lecture_subjects')->where([['academic_year_id', '=', $request->academic_year_id],
        ['lectures_emp_id','=',$request->lectures_emp_id],
        ['subjects_subject_code','=',$request->subjects_subject_code],
        ])->get();

        if(count($result) != 0){
            //Validation : Can't be duplicate
            $this->validate($request, [
                'lectures_emp_id' => 'unique:lecture_subjects',
            ]);
        }

        $lectureSubject = new LectureSubject;
        $lectureSubject->academic_year_id = $request->academic_year_id;
        $lectureSubject->lectures_emp_id = $request->lectures_emp_id;
        $lectureSubject->subjects_subject_code = $request->subjects_subject_code;
        $lectureSubject->save();

        //Toastr notifications
        $notification = array(
            'message' => 'Configuration completed',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lectureSubjects = LectureSubject::where('lectures_emp_id', '=', $id)->get();
        $academicYears = $this->findAcademicYears();
        
        return view('settings.showAssignedSubjects')->with(['lectureSubjects' => $lectureSubjects,
        'academicYears' => $academicYears,
        'employee_id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $academicYears = $this->findAcademicYears();
        $subjects = $this->findSubjects();

        return view('settings.addSubjectsToLecture')->with(['academicYears' => $academicYears,
            'subjects' => $subjects,
            'employee_id' => $id]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lectureSubject = LectureSubject::findOrFail($id);
        $lectureSubject->delete();
        return response()->json($lectureSubject);
    }

    public function findAcademicYears()
    {
        return AcademicYear::all();
    }

    public function findSubjects()
    {
        return Subject::all();
    }
}
