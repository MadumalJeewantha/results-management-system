<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class studentsExcelExport implements FromView
{
    public $students;
    public $columns;

    public function __construct($students, $columns) {
        $this->students = $students;
        $this->columns = $columns;
    }

    public function view(): View
    {
        
        return view('reports.excel.studentsExcelExport')->with( [ 
            'students' => $this->students,  
            'columns' => $this->columns, 
            ]);
           
        
    }
}
