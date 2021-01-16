<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class subjectResultsExcelExport implements FromView
{
    public $grades;

    public function __construct($grades) {
        $this->grades = $grades;
    }

    public function view(): View
    {
        
        return view('reports.excel.subjectResultsExcelExport')->with( [ 
            'grades' => $this->grades,  
            ]);
           
        
    }
}
