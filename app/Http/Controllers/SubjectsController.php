<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Course;
use App\Department; 
use App\SpecializedArea;
use App\User;
use Illuminate\Support\Facades\DB;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

class SubjectsController extends Controller
{
    public function __construct(){
        $this->middleware('config');
        $this->middleware('auth');
        $this->middleware('deansonly');
        $this->middleware('ifStudent',['except'=> ['index']]);
        $this->middleware('ifLecture',['except'=> ['index']]);
        $this->middleware('ifAR',['except'=> ['index']]);

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
        // Send Course | Subjects | Specialized Area Details 
        $courses = $this->findCourses();
        $specializedAreas = $this->findSpecializedAreas();
        $subjects = Subject::all();

        return view('subjects.index')->with(['courses' => $courses,
            'specializedAreas' => $specializedAreas,
            'subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Send Course | SpecializedArea | Department details
        $departments = $this->findDepartments();
        $courses = $this->findCourses();
        $specializedAreas = $this->findSpecializedAreas();

        //route for subjects creation
        return view('subjects.create')->with([
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
        $this->validate($request, [

            'subject_code' => 'required|unique:subjects',
            'course_id' => 'required',
            'department_id' => 'required',
            'specialized_area_id' => 'required',
            'title' => 'required',
            'credits' => 'required',
            'status' => 'required',
            'year' => 'required',
            'semester' => 'required',

        ]);

        // Subject creation
        for ($i = 0; $i < count($request->subject_code); $i++) {
            $subject = new Subject;
            $subject->subject_code = $request->subject_code[$i];
            $subject->course_id = $request->course_id[$i];
            $subject->department_id = $request->department_id[$i];
            $subject->specialized_area_id = $request->specialized_area_id[$i];
            $subject->title = $request->title[$i];
            $subject->credits = $request->credits[$i];
            $subject->status = $request->status[$i];
            $subject->year = $request->year[$i];
            $subject->semester = $request->semester[$i];

            $subject->save();
        }

        if ((count($request->name)) > 1) {
            $msg = "Subjects added to the system";
        } else {
            $msg = "Subject added to the system";
        }

        if ($request->from == 'config') {
            return redirect('/dashboard')->with('success', $msg);
        } else {
            $notification = array(
                'message' => $msg, 
                'alert-type' => 'success'
            );
            return redirect('/subjects')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = $this->findDepartments();
        $courses = $this->findCourses();
        $specializedAreas = $this->findSpecializedAreas();

        $subject = Subject::findOrFail($id);

        return view('subjects.edit')->with(['subject'=> $subject,
        'departments'=> $departments,
        'courses' => $courses,
        'specializedAreas' => $specializedAreas]);
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
         //validation
         $this->validate($request, [
            'subject_code' => 'required',
            'course_id' => 'required',
            'department_id' => 'required',
            'specialized_area_id' => 'required',
            'title' => 'required',
            'credits' => 'required',
            'status' => 'required',
            'year' => 'required',
            'semester' => 'required',
        ]);
      
        // Find subject
        $subject = Subject::find($id);
        //Set update values
        $subject->course_id = $request->course_id;
        $subject->department_id = $request->department_id;
        $subject->specialized_area_id = $request->specialized_area_id;
        $subject->title = $request->title;
        $subject->credits = $request->credits;
        $subject->status = $request->status;
        $subject->year = $request->year;
        $subject->semester = $request->semester;

        $subject->save();

        $notification = array(
            'message' => 'Successfully updated', 
            'alert-type' => 'success'
        );
        return redirect('/subjects')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //Remove from subjects table
         $subject = Subject::findOrFail($id);
         $subject->delete();
 
         return response()->json($subject);
    }
}
