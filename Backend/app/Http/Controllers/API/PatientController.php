<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\Patient as PatientResource;

class PatientController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::all();
    
        return $this->sendResponse(PatientResource::collection($patient), 'Patient retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'pid' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'contact' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $patient = Patient::create($input);
   
        return $this->sendResponse(new PatientResource($patient), 'Patient created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
  
        if (is_null($patient)) {
            return $this->sendError('Patient not found.');
        }
   
        return $this->sendResponse(new PatientResource($patient), 'Patient retrieved successfully.');
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
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'pid' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'contact' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $patient = Patient::find($id);
        $patient->user_id = $input['user_id'];
        $patient->pid = $input['pid'];
        $patient->sex = $input['sex'];
        $patient->address = $input['address'];
        $patient->contact = $input['contact'];
        $patient->save();
   
        return $this->sendResponse(new PatientResource($patient), 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient->delete();
   
        return $this->sendResponse([], 'Patient deleted successfully.');
    }
}
