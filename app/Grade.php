<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    
    //primary key field
    protected $primaryKey = 'id';

    //Relationship with students
    public function student(){
        // Foreign key:student_registration_number        
        return $this->belongsTo('App\Student','student_registration_number');
    }
}
