<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Student;
use App\AcademicYear;
use App\Course;
use App\Department; 
use App\SpecializedArea;
use App\Lecture;



class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('config');
        $this->middleware('auth');
    }

    public function showProfile()
    {
        //Get user type
        $type = Auth::user()->type;
        //Get user object
        $user = Auth::user();

        if ($type == 'dean') {
            return view('profiles.dean')->with('user',$user);

        } elseif ($type == 'ar') {

            return view('profiles.ar')->with('user',$user);

        } elseif ($type == 'lecture') {
            $lecture = Lecture::find(Auth::user()->user_name);
            //Provide full profile
            return view('profiles.lecture')->with('lecture',$lecture);

        } elseif ($type == 'student') {
            $student = Student::find($user->user_name);
            //Provide full profile            
            return view('profiles.student')->with('student', $student );;

        } elseif ($type == 'examination_branch') {

            return view('profiles.exam_branch')->with('user',$user);

        }
    }

    //Method to handle password chaninging 
    public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        //strcmp - used string comparison method
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        //Get the user instance
        $user = Auth::user();
        //encrypt new password using bcrypt
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully");
 
    }

    public function updatePersonalDetails(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        //Save updates
        $user->save();
        return redirect()->back()->with("success","Updated successfully.");
    }

    public function editStudentProfile(){
        if(Auth::user()->type == 'student'){
        $student = Student::find(Auth::user()->user_name);

        $academicYears = $this->findAcademicYears();
        $departments = $this->findDepartments();
        $courses = $this->findCourses();
        $specializedAreas = $this->findSpecializedAreas();

        return view('profiles.editStudentProfile')->with(['academicYears' => $academicYears,
        'departments' => $departments,
        'courses' => $courses,
        'specializedAreas' => $specializedAreas, 
        'student' => $student]);

        }else{
            return redirect()->back()->with("warning","Unauthorized page.");
        }
    }

    public function updateStudentProfile(Request $request, $id){
         // Find student
         $student = Student::find($id);

         //validation
         $this->validate($request, [
            
            'gender' => 'required',
            'marriage_state' => 'required',
            'email' => ($student->email == $request->input('email') ? 'email|nullable' : 'email|nullable|unique:students'),
            'contact_no_mobile' => 'nullable|min:10',
            'contact_no_home' => 'nullable|min:10',
            'home_address_1' => 'nullable',
            'home_address_2' => 'nullable',
            'home_address_3' => 'nullable',
            'current_address_1' => 'nullable',
            'current_address_2' => 'nullable',
            'current_address_3' => 'nullable',
            'fb_url' => 'nullable',
            'linkedin_url' => 'nullable',
            'father_name' => 'nullable',
            'father_occupation' => 'nullable',
            'mother_name' => 'nullable',
            'mother_occupation' => 'nullable',
            'number_of_sisters_and_brothers' => 'nullable',
            'dissertation_title' => 'nullable',
            'dissertation_published_link' => 'nullable',
            'supervisor_name' => 'nullable',
            'profile_picture' => 'image|nullable|max:1999',
            'bio' => 'nullable',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture')->store('public/avatars');
            $path = str_replace("public/avatars","/storage/avatars",$file);

        } else {
            $path = $request->input('_img_path');
        }
        
        //Set updated values
     
        $student->gender = $request->input('gender');
        $student->marriage_state = $request->input('marriage_state');
        $student->email = $request->input('email');
        $student->contact_no_mobile = $request->input('contact_no_mobile');
        $student->contact_no_home = $request->input('contact_no_home');
        $student->home_address_1 = $request->input('home_address_1');
        $student->home_address_2 = $request->input('home_address_2');
        $student->home_address_3 = $request->input('home_address_3');
        $student->current_address_1 = $request->input('current_address_1');
        $student->current_address_2 = $request->input('current_address_2');
        $student->current_address_3 = $request->input('current_address_3');
        $student->fb_url = $request->input('fb_url');
        $student->linkedin_url = $request->input('linkedin_url');
        $student->father_name = $request->input('father_name');
        $student->father_occupation = $request->input('father_occupation');
        $student->mother_name = $request->input('mother_name');
        $student->mother_occupation = $request->input('mother_occupation');
        $student->number_of_sisters_and_brothers = $request->input('number_of_sisters_and_brothers');
        $student->dissertation_title = $request->input('dissertation_title');
        $student->dissertation_published_link = $request->input('dissertation_published_link');
        $student->supervisor_name = $request->input('supervisor_name');
        $student->profile_picture = $path;
        $student->bio = $request->input('bio');
        //Save updates
        $student->save();

        // Find user
        $user = User::find($id);
        $user->email = $request->input('email');
        $user->save();

        $notification = array(
            'message' => 'Successfully updated', 
            'alert-type' => 'success'
        );

        return redirect('/profile')->with($notification);
       

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

    public function editLectureProfile(){
        if(Auth::user()->type == 'lecture'){
            $lecture = Lecture::find(Auth::user()->user_name);
            $departments = $this->findDepartments();
    
            return view('profiles.editLectureProfile')->with(['departments' => $departments,
            'lecture' => $lecture]);
    
            }else{
                return redirect()->back()->with("warning","Unauthorized page.");
            }
    }

    public function updateLectureProfile(Request $request, $id){
        // Find lecture
        $lecture = Lecture::find($id);

        //validation
        $this->validate($request, [
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
        return redirect('/profile')->with($notification);

    }

}
