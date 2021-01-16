<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class assignedSubjectsOfSpecificLectureExcelExport implements FromView
{
    public $subjects;

    public function __construct($subjects) {
        $this->subjects = $subjects;
    }

    public function view(): View
    {
        
        return view('reports.excel.assignedSubjectsOfSpecificLectureExcelExport')->with( [ 
            'subjects' => $this->subjects,  
            ]);
           
        
    }
}
