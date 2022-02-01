<?php

namespace App\Http\Controllers\Diseases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Symptom;
use App\Imports\ImportSymptoms;
use Maatwebsite\Excel\Facades\Excel;

class IllnessesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $symptoms = Symptom::all();
        return view('disease.illness.index',compact('symptoms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('disease.illness.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'symptoms_name' => 'required'
            ]);

        $symptom = new Symptom;
        $symptom->symptoms_name = $request->symptoms_name;
        $symptom->symptoms_note = $request->symptoms_note;
        $symptom->save();
        
        return redirect()->route('admin.illnesses.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sysmpt = Symptom::find($id);
        $sysmpt->delete();
        return redirect()->route('admin.illnesses.index')->with('success', 'delete Successful!');
      
    }



    public function import()
    {

            Excel::import(new ImportSymptoms, request()->file('file'));
            return redirect()->route('admin.illnesses.index');
       
    }

}
