<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecializedArea extends Model
{
    //primary key field
    protected $primaryKey = 'specialized_area_id';

    //Relationship with subjects
    public function subject(){
        // Foreign key : specialized_area_id
        return $this->hasMany('App\Subject','specialized_area_id');
    }
 
    //Relationship with students
    public function student(){
        // Foreign key : specialized_area_id
        return $this->hasMany('App\Student','specialized_area_id');
    }
}
