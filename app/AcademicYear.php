<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    //primary key field
    protected $primaryKey = 'academic_year_id';

    //Relationship with student
    public function student(){
        // Foreign key:academic_year_id
        return $this->hasMany('App\Student','academic_year_id');
    }
}
