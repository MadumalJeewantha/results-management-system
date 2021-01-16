<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AcademicYear;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

class AcademicYearsController extends Controller
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
        return view('academic_years.create');
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
            'year' => 'required|unique:academic_years',
            'description' => 'nullable',
        ]);

        // academicYear creation
        for ($i = 0; $i < count($request->year); $i++) {
            $academicYear = new AcademicYear;
            $academicYear->year = $request->year[$i];
            $academicYear->description = $request->description[$i];
            $academicYear->save();
        }

        if ((count($request->year)) > 1) {
            $msg = "Academic Years added to the system";
        } else {
            $msg = "Academic Year added to the system";
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
        $academicYear = AcademicYear::findOrFail($id);

        $rules =[
            'year' => ($academicYear->year == $request->input('year')) ? 'required' : 'required|unique:academic_years',
            'description' => 'nullable',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

        
        $academicYear->year = $request->year;
        $academicYear->description = $request->description;
        $academicYear->save();

        return response()->json($academicYear);
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
        $academicYear = AcademicYear::findOrFail($id);
        $academicYear->delete();
        return response()->json($academicYear);
    }
}
