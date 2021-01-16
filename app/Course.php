<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //primary key field
    protected $primaryKey = 'course_id';

    //Relationship with Subjects
    public function subject(){
        // Foreign key : course_id
        return $this->hasMany('App\Course','course_id');
    }

    //Relationship with Studnts
    public function student(){
        // Foreign key:course_id
        return $this->hasMany('App\Student','course_id');
    }
}
