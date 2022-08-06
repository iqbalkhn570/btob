<?php
     
namespace App\Http\Controllers\Api;
     
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Lottery;
use Validator;
use App\Http\Resources\LotteryResource;
use Faker\Core\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        
        $validator = Validator::make($request->all(), [
            'dates' => 'required|array',
            'games' => 'required|array',
            'datas' => 'required|array'
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $customerId = 5;
        $companyId = 2;

        DB::beginTransaction();
        try {
            //code...
            $dates = $request->dates;
            $games = $request->games;
            $datas = $request->datas;
            $referenceNum = Str::uuid()->toString().'/'.Carbon::now()->year.'/REF';
            foreach ($datas as $key => $value) {
                # code...
                $lotteryData['reference_number'] = $referenceNum;
                $lotteryData['customer_id'] = $customerId;
                $lotteryData['company_id'] = $companyId;
                $lotteryData['number_pattern'] = @$value['number'];
                $lotteryData['big_bet_amount'] = @$value['big_bet'];
                $lotteryData['small_bet_amount'] = @$value['small_bet'];

                $boxType = '2';
                if( @$value['box'] )
                    $boxType = '0';
                elseif( @$value['ibox'] )
                    $boxType = '1';
                $lotteryData['bet_type'] = $boxType;

                $lotteryData['total_amount'] = @$value['amount'];

                $lottery = Lottery::create($lotteryData);
                
                //save customer lotteries slave
                foreach ($games as $key => $game) {
                    foreach ($dates as $key => $date) {
                        # code...
                        $slaveData['customer_lottery_id'] = $lottery->id;
                        $slaveData['game_id'] = $game;
                        $formatedDate = Carbon::createFromFormat('l, d M',$date)->format('Y-m-d');
                        $slaveData['game_date'] = $formatedDate;

                        $slaveData['lottery_number'] = $lottery->number_pattern;
                        DB::table('customer_lotteries_slave')->insert($slaveData);
                    }
                    
                }
            }

        } catch (\Throwable $th) {
            return $this->sendError('Store data error.',$th);       

        }
        DB::commit();

     
        return $this->sendResponse([], 'Lottery created successfully.');
    } 
   
   
    
    
}