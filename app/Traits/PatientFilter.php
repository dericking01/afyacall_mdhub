<?php


namespace App\Traits;


use App\Model\Patient;
use Illuminate\Http\Request;

trait PatientFilter
{
    public function filteredPatient(Request $request)
    {
        $patient = Patient::query();
        $paginate = 10;

        if ($request->query('paginate') != '') {
            $paginate = $request->query('paginate');
        }

        if ($request->query('search_string') != '') {
            $patient->where('firstname', 'like', '%' . $request->query('search_string') . '%')
                ->orWhere('lastname', 'like', '%' . $request->query('search_string') . '%')
                ->orWhere('email', 'like', '%' . $request->query('search_string') . '%')
                ->orWhere('pat_no', 'like', '%' . $request->query('search_string') . '%')
                ->orWhere('phone', 'like', '%' . $request->query('search_string') . '%');
        }

        if ($request->query('order') != '') {
            $patient->orderBy('id', $request->query('order'));
        } else {
            $patient->orderBy('id', 'desc');
        }

        return $patient->paginate($paginate);
    }
}