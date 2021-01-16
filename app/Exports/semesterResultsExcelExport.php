<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class semesterResultsExcelExport implements FromView
{
    public $subjects;
    public $grades;

    public function __construct($subjects , $grades) {
        $this->subjects = $subjects;
        $this->grades = $grades;
    }

    public function view(): View
    {
        
        return view('reports.excel.semesterResultsExcelExport')->with( [ 
            'subjects' => $this->subjects,  
            'grades' => $this->grades, 
            ]);
           
        
    }
}
