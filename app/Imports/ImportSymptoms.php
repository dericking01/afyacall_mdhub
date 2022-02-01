<?php

namespace App\Imports;

use App\Model\Symptom;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSymptoms implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Symptom([
            'symptoms_name' => $row[0],
            // 'symptoms_note' => $row[1],
        ]);
    }
}
