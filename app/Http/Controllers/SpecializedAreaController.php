<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SpecializedArea;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

class SpecializedAreaController extends Controller
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
        return view('specialized_areas.create');
        
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

            'name' => 'required|unique:specialized_areas',
            'description' => 'nullable',
        ]);

        // specializedArea creation
        for ($i = 0; $i < count($request->name); $i++) {
            $specializedArea = new SpecializedArea;
            $specializedArea->name = $request->name[$i];
            $specializedArea->description = $request->description[$i];
            $specializedArea->save();
        }

        if ((count($request->name)) > 1) {
            $msg = "Specialized Areas added to the system";
        } else {
            $msg = "Specialized Area added to the system";
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
        $specializedArea = SpecializedArea::findOrFail($id);

        $rules =[
            'name' => ($specializedArea->name == $request->input('name')) ? 'required' : 'required|unique:specialized_areas',
            'description' => 'nullable',
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

        
        $specializedArea->name = $request->name;
        $specializedArea->description = $request->description;
        $specializedArea->save();

        return response()->json($specializedArea);
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
        $specializedArea = SpecializedArea::findOrFail($id);
        $specializedArea->delete();
        return response()->json($specializedArea);
    }
}
