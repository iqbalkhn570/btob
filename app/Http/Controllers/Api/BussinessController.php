<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\BussinessResorce;
use App\Models\Company;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class BussinessController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bussiness = Company::all();
      
        return $this->sendResponse(BussinessResorce::collection($bussiness), 'Bussiness retrieved successfully.');
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
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input['slug'] = Str::slug($input['name']);
        $bussiness = Company::create($input);
     
        
        return $this->sendResponse(new BussinessResorce($bussiness), 'Bussiness created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bussiness = Company::find($id);
    
        if (is_null($bussiness)) {
            return $this->sendError('Brand not found.');
        }
     
        return $this->sendResponse(new BussinessResorce($bussiness), 'Bussiness retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $bussiness)
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $bussiness->name = $input['name'];
        $bussiness->slug = Str::slug($input['name']);
        $bussiness->save();
     
        return $this->sendResponse(new BussinessResorce($bussiness), 'Bussiness updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $bussiness)
    {
        $bussiness->delete();
     
        return $this->sendResponse([], 'Bussiness deleted successfully.');
    }
}
