<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Appoinment;
use Validator;
use App\Http\Resources\Appoinment as AppoinmentResource;

class AppoinmentController extends BaseController
{
    public function index()
    {
        $appoinment = Appoinment::all();
    
        return $this->sendResponse(AppoinmentResource::collection($appoinment), 'Appoinment retrieved successfully.');
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
            'title' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'attendees' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $appoinment = Appoinment::create($input);
   
        return $this->sendResponse(new AppoinmentResource($appoinment), 'Appoinment created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appoinment = Appoinment::find($id);
  
        if (is_null($appoinment)) {
            return $this->sendError('Appoinment not found.');
        }
   
        return $this->sendResponse(new AppoinmentResource($appoinment), 'Appoinment retrieved successfully.');
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
            'title' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'attendees' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $appoinment = Appoinment::find($id);
        $appoinment->title = $input['title'];
        $appoinment->startDate = $input['startDate'];
        $appoinment->endDate = $input['endDate'];
        $appoinment->attendees = $input['attendees'];
        $appoinment->save();
   
        return $this->sendResponse(new AppoinmentResource($appoinment), 'Appoinment updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appoinment $appoinment)
    {
        $appoinment->delete();
   
        return $this->sendResponse([], 'Appoinment deleted successfully.');
    }
}
