<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class assignedSubjectsOfStudentExcelExport implements FromView
{
    public $student;
    public $columns;
    public $subjects;
    public $studentSubjects;
    public $common_subjects_id;

    public function __construct($student, $studentSubjects , $subjects , $columns , $common_subjects_id) {
        $this->student = $student;
        $this->studentSubjects = $studentSubjects;
        $this->subjects = $subjects;
        $this->columns = $columns;
        $this->common_subjects_id = $common_subjects_id;
    }

    public function view(): View
    {
        
        return view('reports.excel.assignedSubjectsOfStudentExcelExport')->with( [ 
            'student' => $this->student,  
            'columns' => $this->columns, 
            'studentSubjects' => $this->studentSubjects, 
            'subjects' => $this->subjects, 
            'common_subjects_id' => $this->common_subjects_id,

            ]);
           
        
    }
}
