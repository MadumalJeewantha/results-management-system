<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{

    //primary key field
    protected $primaryKey = 'employee_id';
    public  $incrementing = false;


    //Relationship with Department
    public function department(){
        // Foreign key : departmetnt_id
        return $this->belongsTo('App\Department','department_id');
    }    

    //Relationship with subjects
    public function subject(){
        //lectures_emp_id
        //Subjects_subject_id
        return $this->belongsToMany('App\Subject','lecture_subjects','lectures_emp_id','subjects_subject_id');
    }
}
