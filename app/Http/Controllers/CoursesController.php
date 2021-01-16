<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('config');
        $this->middleware('deansonly');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
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

            'name' => 'required|unique:courses',
            'description' => 'nullable',
        ]);

        // Course creation
        for ($i = 0; $i < count($request->name); $i++) {
            $course = new Course;
            $course->name = $request->name[$i];
            $course->description = $request->description[$i];
            $course->save();
        }

        if ((count($request->name)) > 1) {
            $msg = "Courses added to the system";
        } else {
            $msg = "Course added to the system";
        }

        if ($request->from == 'config') {            
            return redirect('/dashboard')->with('success', $msg);
        }else{
            $notification = array(
                'message' => $msg, 
                'alert-type' => 'success'
            );
            return redirect('/courses')->with($notification);
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
        //
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
         
        $rules =[
            'name' => 'required',
            'description' => 'nullable',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        return response()->json($course);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json($course);
    }

   
}
