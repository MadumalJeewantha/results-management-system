<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grading;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

class GradingsController extends Controller
{
    public function __construct(){
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gradings.create');

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
            'grade' => 'required|unique:gradings',
            'points' => 'required',
        ]);

        // gradings creation
        for ($i = 0; $i < count($request->grade); $i++) {
            $gradings = new Grading;
            $gradings->grade = $request->grade[$i];
            $gradings->points = $request->points[$i];
            $gradings->save();
        }

        if ((count($request->grade)) > 1) {
            $msg = "Grades added to the system";
        } else {
            $msg = "Grade added to the system";
        }

        if ($request->from == 'config') {
            return redirect('/dashboard')->with('success', $msg);
        } else {
            $notification = array(
                'message' => $msg, 
                'alert-type' => 'success'
            );
            return redirect('/settings')->with($notification);
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
        $grading = Grading::findOrFail($id);

        $rules =[
            'grade' => ($grading->grade == $request->input('grade')) ? 'required' : 'required|unique:gradings',
            'points' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

        
        $grading->grade = $request->grade;
        $grading->points = $request->points;
        $grading->save();

        return response()->json($grading);
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
        $gradings = Grading::findOrFail($id);
        $gradings->delete();
        return response()->json($gradings);
    }
}
