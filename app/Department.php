<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //primary key field
    protected $primaryKey = 'department_id';

    //Relationship with lectures
    public function lecture(){
        // Foreign key : department_id
        return $this->hasMany('App\lecture','department_id');
    }

    //Relationship with Subjects
    public function subject(){
        // Foreign key : department_id
        return $this->hasMany('App\Subject','department_id');
    }

    //Relationship with Students
    public function student(){
        // Foreign key:department_id
        return $this->hasMany('App\Student','department_id');
    }
}
