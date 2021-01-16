<?php

namespace App\Imports;

use App\Grade;
use Maatwebsite\Excel\Concerns\ToModel;

//This is used for import grades from excel file
//This will override by 'Excel::toArray' in GradesController
class ImportGrades implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Grade([
            'student_registration_number' => $row[0],
            'grade' => $row[1],
        ]);
    }
}
