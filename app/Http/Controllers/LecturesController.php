<?php

namespace App\Http\Controllers;

use App\Department;
use App\Lecture;
use App\LectureSubject;
use App\User;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\DB;


class LecturesController extends Controller
{

    public function __construct()
    {
        $this->middleware('config');
        $this->middleware('auth');
        $this->middleware('ARorDean',['except'=> ['index','show']]);
        $this->middleware('ifStudent'); 
        $this->middleware('ifLecture',['except'=> ['index','show']]);

    }

    public function findDepartments()
    {
        return Department::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectures = Lecture::all();
        return view('lectures.index')->with(['lectures'=> $lectures, 'lecturesCountChart' => $this->lecturesCountChart()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //send departments
        $departments = $this->findDepartments();

        //route for Lectures creation
        return view('lectures.create')->with(['departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation
        $this->validate($request, [
            'employee_id' => 'required|unique:lectures',
            'department_id' => 'required',
            'initials' => 'required',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'required|email|unique:lectures',
            'mobile' => 'nullable|min:10',
            'gender' => 'required',
            'qualifications' => 'nullable',
            'bio' => 'nullable',
            'profile_picture' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture')->store('public/avatars');
            $path = str_replace("public/avatars","/storage/avatars",$file);

        } else {
            $path = '/storage/avatars/no_image.png';
        }

        // Create lecture
        $lecture = new Lecture;

        $lecture->employee_id = $request->input('employee_id');
        $lecture->department_id = $request->input('department_id');
        $lecture->initials = $request->input('initials');
        $lecture->first_name = $request->input('first_name');
        $lecture->last_name = $request->input('last_name');
        $lecture->email = $request->input('email');
        $lecture->mobile = $request->input('mobile');
        $lecture->gender = $request->input('gender');
        $lecture->qualifications = $request->input('qualifications');
        $lecture->profile_picture = $path;
        $lecture->bio = $request->input('bio');
        $lecture->save();

        //generate password
        $password = str_random(20);

        //Add to user
        $user = new User;
        $user->user_name = $request->input('employee_id');
        $user->name = $request->input('first_name');
        $user->type = 'lecture';
        $user->email = $request->input('email');
        $user->password = bcrypt($password);
        $user->save();

        //send email
        $data = (['user_name' => $request->input('employee_id'),
                  'name' => $request->input('first_name'),  
                  'email' => $request->input('email'),
                  'password' => $password]);
        SendEmailJob::dispatch($data);

        $notification = array(
            'message' => 'Lecture created. Password has been sent to '. $request->email , 
            'alert-type' => 'success'
        );
        return redirect('/lectures/create')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lecture = Lecture::find($id);
        return view('lectures.view')->with('lecture',$lecture);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Send Department details        
        $departments = $this->findDepartments();
        $lecture = Lecture::find($id);

        return view('lectures.edit')->with(['departments' => $departments, 'lecture' => $lecture]);
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
        // Find lecture
        $lecture = Lecture::find($id);

        //validation
        $this->validate($request, [
            'department_id' => 'required',
            'initials' => 'required',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => ($lecture->email == $request->input('email') ? 'email|required' : 'email|required|unique:lectures'),
            'mobile' => 'nullable|min:10',
            'gender' => 'required',
            'qualifications' => 'nullable',
            'bio' => 'nullable',
            'profile_picture' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture')->store('public/avatars');
            $path = str_replace("public/avatars","/storage/avatars",$file);

        } else {
            $path = $request->input('_img_path');
        }

        
        //Set update values
        $lecture->department_id = $request->input('department_id');
        $lecture->initials = $request->input('initials');
        $lecture->first_name = $request->input('first_name');
        $lecture->last_name = $request->input('last_name');
        $lecture->email = $request->input('email');
        $lecture->mobile = $request->input('mobile');
        $lecture->gender = $request->input('gender');
        $lecture->qualifications = $request->input('qualifications');
        $lecture->profile_picture = $path;
        $lecture->bio = $request->input('bio');
        $lecture->save();

        //Add to user
        $user = User::find($id);
        $user->name = $request->input('first_name');
        $user->email = $request->input('email');
        $user->save();

        $notification = array(
            'message' => 'Successfully updated', 
            'alert-type' => 'success'
        );
        return redirect('/lectures')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Remove from lectures table
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();

        //Remove from user registration
        $user = User::findOrFail($id);
        $user->delete();

        //Remove from lecture_subjects
        $subjects = LectureSubject::where('lectures_emp_id',$id)
        ->delete();

        return response()->json($lecture);
    }

    public function lecturesCountChart(){

        $lectures = DB::select("select count(employee_id) as count, department_id from lectures group by department_id");

        $labels = array();
        $data = array();
        $backgroundColor = array();

        $i = 0;
        foreach ($lectures as $lecture) {
           $labels[$i] = Department::find($lecture->department_id)->name;
           $data[$i] = $lecture->count; 
           $backgroundColor[$i] ='#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
           $i++;
        }

        $chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('doughnut')
         ->size(['width' => 400, 'height' => 100])
         ->labels($labels)
         ->datasets([
             [
                 "label" => "My First dataset",
                 'backgroundColor' => $backgroundColor,
                 'data' => $data,
                 
             ],
           
         ])
         ->options([
            'legend' => [
                'display' => true,
                'position' => 'right',
                ]
         ]);

         return $chartjs;
    }

}
