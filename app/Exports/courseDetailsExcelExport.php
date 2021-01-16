<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class courseDetailsExcelExport implements FromView
{
    public $subjects;
    public $specializedAreas;

    public function __construct($subjects , $specializedAreas) {
        $this->subjects = $subjects;
        $this->specializedAreas = $specializedAreas;
    }

    public function view(): View
    {
        
        return view('reports.excel.courseDetailsExcelExport')->with( [ 
            'subjects' => $this->subjects,  
            'specializedAreas' => $this->specializedAreas, 
            ]);
           
        
    }
}
