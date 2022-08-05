<?php
     
namespace App\Http\Controllers\Api;
     
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Lottery;
use Validator;
use App\Http\Resources\LotteryResource;
     
class LotteryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Lotteries = Lottery::all();
      
        return $this->sendResponse(BrandResource::collection($Lotteries), 'Lotteries retrieved successfully.');
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
        print_r($input);die;
     
        $validator = Validator::make($input, [
            //'number_pattern' => 'required',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
     
        $lottery = Lottery::create($input);
     
        return $this->sendResponse(new LotteryResource($lottery), 'Lottery created successfully.');
    } 
   
   
    
    
}