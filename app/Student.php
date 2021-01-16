<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Student model
class Student extends Model
{
    //primary key field
    protected $primaryKey = 'student_registration_number';
    //Set primary key incrementing false
    public  $incrementing = false;


    //Relationship with Grades
    public function grade(){
        // Foreign key:student_registration_number        
        return $this->hasMany('App\Grade','student_registration_number');
    }

    //Relationship with SpecializedArea
    public function specializedArea(){
        // Foreign key:specialized_area_id
        return $this->belongsTo('App\SpecializedArea','specialized_area_id');
    }

    //Relationship with courses
    public function course(){
        // Foreign key:course_id
        return $this->belongsTo('App\Course','course_id');
    }

    //Relationship with Department
    public function department(){
        // Foreign key:department_id
        return $this->belongsTo('App\Department','department_id');
    }

    //Relationship with AcademicYear
    public function academicYear(){
        // Foreign key:academic_year_id
        return $this->belongsTo('App\AcademicYear','academic_year_id');
    }

    //Relationship with subjects
    public function subject(){
        // students_stu_reg_no
        // subjects_subject_code
        return $this->belongsToMany('App\Subject','student_subjects','students_stu_reg_no','subjects_subject_code');
    }
}
