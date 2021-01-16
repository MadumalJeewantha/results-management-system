<?php

namespace App\Exports;

use App\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class gradingSystemExcelExport implements FromView
{
    public $gradings;

    public function __construct($gradings) {
        $this->gradings = $gradings;
    }

    public function view(): View
    {
        
        return view('reports.excel.gradingSystemExcelExport')->with( [ 
            'gradings' => $this->gradings,  
            ]);
           
        
    }
}
