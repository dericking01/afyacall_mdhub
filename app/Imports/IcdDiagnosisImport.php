<?php

namespace App\Imports;

use App\Model\IcdDiagnosis;
use Maatwebsite\Excel\Concerns\ToModel;

class IcdDiagnosisImport implements ToModel
{
    public function model(array $row)
    {
        return new IcdDiagnosis([
            'code' => $row[0],
            'description' => $row[1],
        ]);
    }
}
