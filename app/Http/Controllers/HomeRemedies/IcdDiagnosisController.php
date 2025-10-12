<?php

namespace App\Http\Controllers\HomeRemedies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\IcdDiagnosis;

class IcdDiagnosisController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        $icdDiagnoses = IcdDiagnosis::where('code', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(20)
            ->get(['id', 'code', 'description']);

        $results = $icdDiagnoses->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => "{$item->code} - {$item->description}",
            ];
        });

        return response()->json(['results' => $results]);
    }
}
