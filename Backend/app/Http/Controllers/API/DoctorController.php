<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Doctor;
use Validator;
use App\Http\Resources\Doctor as DoctorResource;

class DoctorController extends BaseController
{
    public function index()
    {
        $doctor = Doctor::all();
    
        return $this->sendResponse(DoctorResource::collection($doctor), 'Doctor retrieved successfully.');
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
            'name' => 'required',
            'phone' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $doctor = Doctor::create($input);
   
        return $this->sendResponse(new DoctorResource($doctor), 'Doctor created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);
  
        if (is_null($doctor)) {
            return $this->sendError('Doctor not found.');
        }
   
        return $this->sendResponse(new DoctorResource($doctor), 'Doctor retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'phone' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $doctor = Doctor::find($id);
        $doctor->name = $input['name'];
        $doctor->phone = $input['phone'];
        $doctor->save();
   
        return $this->sendResponse(new DoctorResource($doctor), 'Doctor updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
   
        return $this->sendResponse([], 'Doctor deleted successfully.');
    }
}
