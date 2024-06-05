<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\Medicine as MedicineResource;

class MedicineController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicine = Medicine::all();
    
        return $this->sendResponse(MedicineResource::collection($medicine), 'Medicine retrieved successfully.');
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
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'expired' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $medicine = Medicine::create($input);
   
        return $this->sendResponse(new MedicineResource($medicine), 'Medicine created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicine = Medicine::find($id);
  
        if (is_null($medicine)) {
            return $this->sendError('Medicine not found.');
        }
   
        return $this->sendResponse(new MedicineResource($medicine), 'Medicine retrieved successfully.');
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
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'expired' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $medicine = Medicine::find($id);
        $medicine->code = $input['code'];
        $medicine->name = $input['name'];
        $medicine->price = $input['price'];
        $medicine->expired = $input['expired'];
        $medicine->save();
   
        return $this->sendResponse(new MedicineResource($medicine), 'Medicine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine->delete();
   
        return $this->sendResponse([], 'Medicine deleted successfully.');
    }
}
