<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;


trait GPA{

  public function calculateGPA($id){ 
    //Formula      
    //GPA = sum(GPV) / sum(credits)

    //Conditions
    //$id = student_registration_number
    //Grades.published = true
    //Check repeat subjects

    //Initiate variables
    $gpv = 0;
    $credits = 0;
    
    //Manage Not Repeated subjects
    //Find SUM of gpv
    $gpv += DB::table('grades')   
    ->where([['student_registration_number','=',$id], ['published','=',true], ['repeat','=', false] ])
    ->get()
    ->sum('gpv');

    //Find SUM of credits
    $credits += DB::table('grades')
    ->where([['student_registration_number','=',$id], ['published','=',true], ['repeat','=', false] ])
    ->get()
    ->sum('credits');

    //Manage Repeated Subjects
    //Find repeated subjects of $id student
    $repeatedSubjects = DB::table('grades')
    ->distinct('subject_code')
    ->select('subject_code','credits')
    ->where([['student_registration_number','=', $id], ['published','=',true], ['repeat','=',true] ])
    ->get();

    //Loop through repeated subjects
    foreach($repeatedSubjects as $repeatedSubject){
        //List down repeat->ASC Exam year
        $list = DB::table('grades')
        ->where([['student_registration_number','=',$id], ['published','=',true], ['repeat','=',true], ['subject_code','=', $repeatedSubject->subject_code] ])
        ->orderBy('exam_year','ASC')
        ->get();

        //Note
        //1 -> AB(Absent without valid reason) | MC(Medical) | DFR(Absent due tot valid reason) --> Skip to --> Max result
        //Lower than B --> max(B) points(3.0)
        //if less than points(3.00) --> can repeat
        //Points( 0 -> 3.0) if not (1)

        //Create Array
        // $list = $list->toArray; Not used, created manually
        
        //Initialte array
        //0=>id | 1=>grade | 2=>points_value | 3=>exam_year | 4=>max_points | 5=>status
        $array;
        //manage array index
        $count = 0;
        foreach($list as $item){

            $array[$count]['0'] = $item->id;
            $array[$count]['1'] = $item->grade;
            $array[$count]['2'] = $item->points_value;
            $array[$count]['3'] = $item->exam_year;

            //Set increment
            $count++;
        }


        //AB id
        $AB = DB::table('gradings')
        ->select('id')
        ->where('grade','=','AB')
        ->first();

        //Mc id
        $MC = DB::table('gradings')
        ->where('grade','=','MC')
        ->first();

        //DFR id
        $DFR = DB::table('gradings')
        ->select('id')
        ->where('grade','=','DFR')
        ->first();

        //Note
        //max_points - To identify fresh sitting
        //status     - To calculate GPA

        //Manage max_points
        for($i = 0; count($array) > $i; $i++){

            //run only for first element
            //Because AB || MC || DFR valid to get gpv = 4 only for fresh sitting
            //Just like a fresh sitting
            if($i == 0){
                //if the grade AB || MC || DFR --> max_points(4.0)
                if($array[$i]['1'] == $AB->id || $array[$i]['1'] == $MC->id || $array[$i]['1'] == $DFR->id ){
                    //max_points(4.0)->[4]
                    $array[$i]['4'] = '4.0';
                    //status[5]
                    $array[$i]['5'] = '0';

                }else{
                    //max_points(3.0)->[4]
                    //if current points_value > 3.0
                    $array[$i]['4'] = '3.0';                        
                    //status[5] --> current points_value
                    $array[$i]['5'] = $array[$i]['2'];

                }

                //continue the loop whith in the if
                continue;
            } 

            //if the current grade is a MC||AB||DFR
            //if previous max_points has 4.0 && current grade is accaptable for max_value(4.0)
            if($array[$i]['1'] == $AB->id || $array[$i]['1'] == $MC->id || $array[$i]['1'] == $DFR->id ){
                //Check previous max_points[4] & Status[5]
                if($array[$i - 1]['4'] == '4.0' && $array[$i - 1]['5'] == '0'){
                //It means fresh sitting
                    //max_points(4.0)->[4]
                    $array[$i]['4'] = '4.0';
                    //status[5] --> get from privouse status
                    $array[$i]['5'] =  '0';

                }else{
                //It means previous one is MC|AB|DFR but not a fresh sitting
                    //max_points(3.0)->[4]
                    $array[$i]['4'] = '3.0';

                    //Manage status
                    //points_value[2]
                    //status[5]
                    //if equeal or below status[4]
                    if($array[$i - 1]['5'] <= '3.0'){
                        //status[5]
                        $array[$i]['5'] =  $array[$i - 1]['5'];
                    }else{
                        //status[5] ----> Should be '3.0'
                        $array[$i]['5'] =  '3.0';
                    }
                   
                }
            }else{
            //if cuttent grade is not MC || AB || DFR

                // if previous one is a MC||AB||DFR
                if($array[$i-1]['1'] == $AB->id || $array[$i-1]['1'] == $MC->id || $array[$i-1]['1'] == $DFR->id ){
                    //if it is a fressh sitting
                    if($array[$i - 1]['4'] == '4.0' && $array[$i - 1]['5'] == '0'){
                        //max_points(4.0)->[4]
                        $array[$i]['4'] = '4.0';
                        //status[5] -->set from current points_value
                        $array[$i]['5'] = $array[$i]['2'];
                    }else{
                    //But not a fresh sitting

                        //max_points(4.0)->[4]
                        $array[$i]['4'] = '3.0';
                        
                        //Manage status
                        //points_value[2]
                        //Should be equeal or below cuttent max_points[4]

                        // if cuttent points_value < previous statue
                        if($array[$i]['2'] <=  $array[$i - 1]['5'] ){
                            //get previous state
                            $array[$i]['5'] =  $array[$i - 1]['5'];
                        }else{
                            //assign current points_value with 3.0 condition
                            if($array[$i]['2'] <= '3.0'){
                                //status[5]
                                $array[$i]['5'] =  $array[$i]['2'];
                            }else{
                                //status[5] ----> Should be '3.0'
                                $array[$i]['5'] =  '3.0';
                            }
                        }
                       
                    }
                }else{
                //if previous one is not a MC||AB||DFR

                    //max_points(3.0)->[4]
                    $array[$i]['4'] = '3.0';

                    //Manage state
                    //points_value[2]
                    if($array[$i]['2'] <= $array[$i-1]['5'] ){
                        //state[5]
                        $array[$i]['5'] =  $array[$i-1]['5'];
                    }else{
                        //Should be equeal or below max_points[4]
                        if($array[$i]['2'] <= '3.0'){
                            //state[5]
                            $array[$i]['5'] =  $array[$i]['2'];
                        }else{
                            //state[5] ----> Should be '3.0'
                            $array[$i]['5'] =  '3.0';
                        }
                    }
                       
                }
                
            }                
        }//End of for loop

        //Add gpv, credits values of Repeated subject
        $status = $array[count($array) - 1][5];

        // GPV = Credits * Status
        $gpv += $repeatedSubject->credits * $status;
        // Add to credits
        $credits +=  $repeatedSubject->credits; 
        

    }
            
    //Note
    //Calculate should use Repeated & Not Repeated subjects
    //Handle Division by zero error
    if($credits != 0){
        $GPA = $gpv / $credits;
    }else{
        $GPA = 0;
    }

    return $GPA;
}


//Year - Semester 
//Only the differnce here is using '$semester' parameter
//The rest will be same as previous function
public function calculateGPASemesterWise($id, $year, $semester){
    //GPA = sum(GPV) / sum(credits)
    //Conditions
    //$id = student_registration_number
    //Grades.published = true
    //Check repeat subjects

    $gpv = 0;
    $credits = 0;
    
    //Manage Not Repeated subjects
    //Find SUM of gpv
    $gpv += DB::table('grades')
    ->join('subjects', 'subjects.subject_code', '=', 'grades.subject_code')   
    ->where([['grades.student_registration_number','=',$id], ['grades.published','=',true], ['grades.repeat','=', false],['subjects.year','=',$year],['subjects.semester','=',$semester] ])
    ->get()
    ->sum('gpv');

    //Find SUM of credits
    $credits += DB::table('grades')
    ->join('subjects', 'subjects.subject_code', '=', 'grades.subject_code')   
    ->where([['grades.student_registration_number','=',$id], ['grades.published','=',true], ['grades.repeat','=', false],['subjects.year','=',$year],['subjects.semester','=',$semester] ])
    ->get()
    ->sum('credits');

    //Manage Repeated Subjects
    //Find repeated subjects of $id student
    $repeatedSubjects = DB::table('grades')
    ->join('subjects', 'subjects.subject_code', '=', 'grades.subject_code')   
    ->distinct('grades.subject_code')
    ->select('grades.subject_code','grades.credits')
    ->where([['grades.student_registration_number','=', $id], ['grades.published','=',true], ['grades.repeat','=',true] , ['subjects.year','=',$year],['subjects.semester','=',$semester], ])
    ->get();

    //Loop through repeated subjects
    foreach($repeatedSubjects as $repeatedSubject){
        //List down repeat->ASC Exam year
        $list = DB::table('grades')
        ->where([['student_registration_number','=',$id], ['published','=',true], ['repeat','=',true], ['subject_code','=', $repeatedSubject->subject_code] ])
        ->orderBy('exam_year','ASC')
        ->get();

        //Note
        //1 -> AB(Absent without valid reason) | MC(Medical) | DFR(Absent due tot valid reason) --> Skip to --> Max result
        //Lower than B --> max(B) points(3.0)
        //if less than points(3.00) --> can repeat
        //Points( 0 -> 3.0) if not (1)

        //Create Array
        // $list = $list->toArray; Not used, created manually
        
        //Initialte array
        //0=>id | 4=>grade | 2=>points_value | 3=>exam_year | 4=>max_points | 5=>status
        $array;
        //manage array index
        $count = 0;
        foreach($list as $item){

            $array[$count]['0'] = $item->id;
            $array[$count]['1'] = $item->grade;
            $array[$count]['2'] = $item->points_value;
            $array[$count]['3'] = $item->exam_year;

            //Set increment
            $count++;
        }


        //AB id
        $AB = DB::table('gradings')
        ->select('id')
        ->where('grade','=','AB')
        ->first();

        //Mc id
        $MC = DB::table('gradings')
        ->where('grade','=','MC')
        ->first();

        //DFR id
        $DFR = DB::table('gradings')
        ->select('id')
        ->where('grade','=','DFR')
        ->first();

        //Note
        //max_points - To identify fresh sitting
        //status     - To calculate GPA

        //Manage max_points
        for($i = 0; count($array) > $i; $i++){

            //run only for first element
            if($i == 0){
                //if the grade AB || MC || DFR --> max_points(4.0)
                if($array[$i]['1'] == $AB->id || $array[$i]['1'] == $MC->id || $array[$i]['1'] == $DFR->id ){
                    //max_points(4.0)->[4]
                    $array[$i]['4'] = '4.0';
                    //status[5]
                    $array[$i]['5'] = '0';

                }else{
                    //max_points(3.0)->[4]
                    //if current points_value > 3.0
                    $array[$i]['4'] = '3.0';                        
                    //status[5] --> current points_value
                    $array[$i]['5'] = $array[$i]['2'];

                }

                //continue the loop whith in the if
                continue;
            } 

            //if the current grade is a MC||AB||DFR
            //if previous max_points has 4.0 && current grade is accaptable for max_value(4.0)
            if($array[$i]['1'] == $AB->id || $array[$i]['1'] == $MC->id || $array[$i]['1'] == $DFR->id ){
                //Check previous max_points[4] & Status[5]
                if($array[$i - 1]['4'] == '4.0' && $array[$i - 1]['5'] == '0'){
                //It means fresh sitting
                    //max_points(4.0)->[4]
                    $array[$i]['4'] = '4.0';
                    //status[5] --> get from privouse status
                    $array[$i]['5'] =  '0';

                }else{
                //It means previous one is MC|AB|DFR but not a fresh sitting
                    //max_points(3.0)->[4]
                    $array[$i]['4'] = '3.0';

                    //Manage status
                    //points_value[2]
                    //status[5]
                    //if equeal or below status[4]
                    if($array[$i - 1]['5'] <= '3.0'){
                        //status[5]
                        $array[$i]['5'] =  $array[$i - 1]['5'];
                    }else{
                        //status[5] ----> Should be '3.0'
                        $array[$i]['5'] =  '3.0';
                    }
                   
                }
            }else{
            //if cuttent grade is not MC || AB || DFR

                // if previous one is a MC||AB||DFR
                if($array[$i-1]['1'] == $AB->id || $array[$i-1]['1'] == $MC->id || $array[$i-1]['1'] == $DFR->id ){
                    //if it is a fressh sitting
                    if($array[$i - 1]['4'] == '4.0' && $array[$i - 1]['5'] == '0'){
                        //max_points(4.0)->[4]
                        $array[$i]['4'] = '4.0';
                        //status[5] -->set from current points_value
                        $array[$i]['5'] = $array[$i]['2'];
                    }else{
                    //But not a fresh sitting

                        //max_points(4.0)->[4]
                        $array[$i]['4'] = '3.0';
                        
                        //Manage status
                        //points_value[2]
                        //Should be equeal or below cuttent max_points[4]

                        // if cuttent points_value < previous statue
                        if($array[$i]['2'] <=  $array[$i - 1]['5'] ){
                            //get previous state
                            $array[$i]['5'] =  $array[$i - 1]['5'];
                        }else{
                            //assign current points_value with 3.0 condition
                            if($array[$i]['2'] <= '3.0'){
                                //status[5]
                                $array[$i]['5'] =  $array[$i]['2'];
                            }else{
                                //status[5] ----> Should be '3.0'
                                $array[$i]['5'] =  '3.0';
                            }
                        }
                       
                    }
                }else{
                //if previous one is not a MC||AB||DFR

                    //max_points(3.0)->[4]
                    $array[$i]['4'] = '3.0';

                    //Manage state
                    //points_value[2]
                    if($array[$i]['2'] <= $array[$i-1]['5'] ){
                        //state[5]
                        $array[$i]['5'] =  $array[$i-1]['5'];
                    }else{
                        //Should be equeal or below max_points[4]
                        if($array[$i]['2'] <= '3.0'){
                            //state[5]
                            $array[$i]['5'] =  $array[$i]['2'];
                        }else{
                            //state[5] ----> Should be '3.0'
                            $array[$i]['5'] =  '3.0';
                        }
                    }
                       
                }
                
            }                
        }//End of for loop

        //Add gpv, credits values of Repeated subject
        $status = $array[count($array) - 1][5];

        // GPV = Credits * Status
        $gpv += $repeatedSubject->credits * $status;
        // Add to credits
        $credits +=  $repeatedSubject->credits; 
        

    }
            
    //Note
    //Calculate should use Repeated & Not Repeated subjects
    //Handle Division by zero error
    if($credits != 0){
        $GPA = $gpv / $credits;
    }else{
        $GPA = 0;
    }

    return $GPA;

}

}