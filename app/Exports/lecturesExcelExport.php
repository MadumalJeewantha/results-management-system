<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class lecturesExcelExport implements FromView
{
    public $lectures;
    public $columns;

    public function __construct($lectures, $columns) {
        $this->lectures = $lectures;
        $this->columns = $columns;
    }

    public function view(): View
    {
        
        return view('reports.excel.lecturesExcelExport')->with( [ 
            'lectures' => $this->lectures,  
            'columns' => $this->columns, 
            ]);
           
        
    }
}
