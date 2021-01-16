<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //primary key field
    protected $primaryKey = 'subject_code';
    public  $incrementing = false;


    //Relationship with Departments
    public function department(){
        // Foreign key : department_id
        return $this->belongsTo('App\Department','department_id');
    }

    //Relationship with Courses
    public function course(){
        // Foreign key : course_id
        return $this->belongsTo('App\Course','course_id');
    }

    //Relationship with Specialized_area
    public function specializedArea(){
        // Foreign key : specialized_area_id
        return $this->belongsTo('App\SpecializedArea','specialized_area_id');
    }

    //Relationship with lecture
    public function lecture(){
        //lectures_emp_id
        //Subjects_subject_id
        return $this->belongsToMany('App\Lecture','lecture_subjects','lectures_emp_id','subjects_subject_id');
    }

    //Relationship with student
    public function student(){
        // students_stu_reg_no
        // subjects_subject_code
        return $this->belongsToMany('App\Student','student_subjects','students_stu_reg_no','subjects_subject_code');
    }
}
