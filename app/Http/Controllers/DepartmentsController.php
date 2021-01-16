<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

class DepartmentsController extends Controller
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
        $departments = Department::all();
        return view('departments.index')
        ->with('departments',$departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');

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

            'name' => 'required|unique:departments',
            'department_head_employee_id' => 'required',
            'description' => 'nullable',
        ]);

        // Department creation
        for ($i = 0; $i < count($request->name); $i++) {
            $department = new Department;
            $department->name = $request->name[$i];
            $department->department_head_employee_id = $request->department_head_employee_id[$i];
            $department->description = $request->description[$i];
            $department->save();
        }

        if ((count($request->name)) > 1) {
            $msg = "Departments added to the system";
        } else {
            $msg = "Department added to the system";
        }

        if ($request->from == 'config') {
            return redirect('/dashboard')->with('success', $msg);
        } else {
            $notification = array(
                'message' => $msg, 
                'alert-type' => 'success'
            );
            return redirect('/departments')->with($notification);
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
        //Not allowed to edit Department Name field
        //It act as the Key
        //Name again passed as original value
        $rules =[
            'name' => 'required',
            'department_head_employee_id' => 'required',
            'description' => 'nullable',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->department_head_employee_id = $request->department_head_employee_id;
        $department->description = $request->description;
        $department->save();

        return response()->json($department);
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
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json($department);
    }

}
