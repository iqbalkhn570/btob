<?php
     
namespace App\Http\Controllers\Api;
     
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Lottery;
use Validator;
use App\Http\Resources\LotteryResource;
use App\Models\Brand;
use App\Models\Company;
use Faker\Core\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LotteryController extends BaseController
{

    private $result=[];
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
        $customerLottteryIds = [];
        DB::beginTransaction();
        
        try {
            //code...
            $dates = $request->dates;
            $games = $request->games;
            $datas = $request->datas;
            $referenceNum = Str::uuid()->toString().'-'.Carbon::now()->year.'-REF';
            $company = Company::find($companyId);
            //
             // we have to write a code for genrating numbers for lottery 
            //
            foreach ($datas as $key => $value) {
                # code...
                $this->result = [];
                $lotteryData['reference_number'] = $referenceNum;
                $lotteryData['customer_id'] = $customerId;
                $lotteryData['company_id'] = $companyId;
                $lotteryData['number_pattern'] = @$value['number'];
                $lotteryData['big_bet_amount'] = @$value['big_bet'];
                $lotteryData['small_bet_amount'] = @$value['small_bet'];

                $boxType = '2';
                if( @$value['box'] == 'on' )
                    $boxType = '0';
                elseif( @$value['ibox'] == 'on')
                    $boxType = '1';
                $lotteryData['bet_type'] = $boxType;

                $lotteryData['total_amount'] = @$value['amount'];

                $lottery = Lottery::create($lotteryData);
                array_push($customerLottteryIds, $lottery->id);
                //save customer lotteries slave
                foreach ($games as $key => $game) {
                    foreach ($dates as $key => $date) {
                        # code...
                        
                        $slaveData['customer_lottery_id'] = $lottery->id;
                        $slaveData['game_id'] = $game;
                        
                        $formatedDate = Carbon::createFromFormat('d M, l',$date)->format('Y-m-d');
                       // $formatedDate = Carbon::parse($date)->format('Y-m-d');
                        //die($formatedDate);
                        $slaveData['game_date'] = $formatedDate;

                        
                        //foreach($datas as $key=>$row){

                        if(@$value['box']=='on' || @$value['ibox']=='on'){
                        
                            $str = @$value['number'];
                
                            $n = strlen($str);
                                
                            
                            $this->permute($str, 0, $n - 1);
                            
                            $temp = [];
                            for($j=0; $j<count($this->result); $j++){
                                if(!in_array($this->result[$j],$temp)){
                                    array_push($temp,$this->result[$j]);
                                
                                }
                            }
                            
                            if(@$value['box']=='on'){

                                $slaveData['amount'] = @$value['amount'];
                            }
                            else{
                                $slaveData['amount'] =round( @$value['amount']/count($temp), 2);
                            }
                            
                            foreach($temp as $key=>$row){
                                //die('khan');
                                $slaveData['lottery_number'] = $row;
                                $slaveData['commission'] = $company->commission;
                                $slaveData['net_amount'] = round ($slaveData['amount']+($slaveData['amount']*$company->commission/100), 2) ;
                                DB::table('customer_lotteries_slave')->insert($slaveData);
                            }
                        }else{
                            $slaveData['lottery_number'] =@$value['number'];
                            $slaveData['amount'] = @$value['amount'];
                            $slaveData['commission'] = $company->commission;
                            $slaveData['net_amount'] = $slaveData['amount']+($slaveData['amount']*$company->commission/100);
                            DB::table('customer_lotteries_slave')->insert($slaveData);
                        }
                       // }

                    }
                    
                }
            }

        } catch (\Throwable $th) {
           
            Log::error($th);
            return $this->sendError('Store data error.',$th);       

        }
        DB::commit();

        return $this->sendResponse([], 'Lottery created successfully.',['reference_number' => $referenceNum]);
    } 

    // PHP program to print all
    // permutations of a given string.

    /* Permutation function @param
    str string to calculate permutation
    for @param l starting index @param
    r end index */
    
    function permute($str, $l, $r)
    { 
       
        if ($l == $r){
            //echo $str. "\n";
            $this->result[] = $str;
        }
        else{
            for ($i = $l; $i <= $r; $i++)
            {
                $str = $this->swap($str, $l, $i);
                $this->permute($str, $l + 1, $r);
                $str = $this->swap($str, $l, $i);
            }
        }
        //return $result;
    }

    /* Swap Characters at position @param
    a string value @param i position 1
    @param j position 2 @return swapped
    string */
    function swap($a, $i, $j)
    {
        $charArray = str_split($a);
        $temp = $charArray[$i] ;
        $charArray[$i] = $charArray[$j];
        $charArray[$j] = $temp;
        return implode($charArray);
    }
    public function show(Request $request, $customerId)
    {
        $validator = Validator::make($request->all(), [
            'ref_id' => 'required',
            'flag' => 'required|in:settled,unsettled'

        ],[
            'flag.in' => 'flag must be settled or unsettled'
        ]);
        $referenceId = $request->ref_id;
        $flag = $request->flag;
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $lotteries = DB::table('customer_lotteries')
                                ->join('customer_lotteries_slave','customer_lotteries.id','=','customer_lotteries_slave.customer_lottery_id')
                                ->where('customer_lotteries.customer_id',$customerId)
                                ->select('customer_lotteries_slave.game_date as date')
                                ->groupBy('customer_lotteries_slave.game_date')
                                ->orderBy('customer_lotteries_slave.game_date','DESC');

        if($referenceId)
            $lotteries = $lotteries->where('customer_lotteries.reference_number', $referenceId);

        $flagString = '';
        if($flag == 'settled')
            $flagString = 'Finished';
        elseif($flag == 'unsettled')
            $flagString = 'Inprocess';
        if($flagString)
            $lotteries = $lotteries->where('customer_lotteries_slave.status', $flagString);

            
        $lotteries= $lotteries->get();
        
        $x = 1;
        foreach($lotteries as $key=> $lotteriesVal){
            $lotteries[$key]->id = $x;
            $x++;
        }
        $lotteries->map(function ($lottery) use($customerId, $flagString, $referenceId)
        {
            # code...
            $lottery->day_name = Carbon::createFromFormat('Y-m-d', $lottery->date)->format('d M, l');

            //getting game list with lottery list
            $games = Brand::join('customer_lotteries_slave','customer_lotteries_slave.game_id','=','brands.id')
                            ->join('customer_lotteries','customer_lotteries_slave.customer_lottery_id','=','customer_lotteries.id')
                            ->distinct('game_name')
                            ->select('brands.name as game_name','brands.id as game_id')
                            ->where('customer_lotteries.customer_id',$customerId)
                            ->where('customer_lotteries_slave.game_date',$lottery->date);

            if($referenceId)
                $games = $games->where('customer_lotteries.reference_number', $referenceId);

            if($flagString)
                $games = $games->where('customer_lotteries_slave.status', $flagString);

            $games= $games->get();   
            $y = 1;
            foreach($games as $key=> $gamesVal){
                $games[$key]->id = $y;
                $y++;
            }
            $games->map(function($game) use($customerId, $lottery, $flagString, $referenceId){
                $lotteryDatas = Lottery::join('customer_lotteries_slave','customer_lotteries.id','=','customer_lotteries_slave.customer_lottery_id')
                                ->where('customer_lotteries.customer_id',$customerId)
                                ->where('customer_lotteries_slave.game_date',$lottery->date)
                                ->where('customer_lotteries_slave.game_id',$game->game_id)
                                ->distinct('customer_lotteries_slave.lottery_number')
                                ->select(
                                    'customer_lotteries_slave.id',
                                    'customer_lotteries.big_bet_amount',
                                    'customer_lotteries.small_bet_amount',
                                    'customer_lotteries.bet_type',
                                    'customer_lotteries_slave.lottery_number',
                                    'customer_lotteries_slave.amount',
                                    'customer_lotteries_slave.status',
                                    'customer_lotteries_slave.commission',
                                    'customer_lotteries_slave.net_amount',
                                    DB::raw("total_amount + (total_amount * customer_lotteries_slave.commission/100) AS net_amount"),
                                );
                if($referenceId)
                    $lotteryDatas = $lotteryDatas->where('customer_lotteries.reference_number', $referenceId);

                if($flagString)
                    $lotteryDatas = $lotteryDatas->where('customer_lotteries_slave.status', $flagString);
    
                $lotteryDatas= $lotteryDatas->get()
                                ->each(function ($row, $index) {
                                    $row->srno = $index + 1;
                                });
                $game->lotteries = $lotteryDatas;
            });
            $lottery->games = $games;

        });
        return $this->sendResponse($lotteries, 'Lotteries retrieved successfully.');
    }

    public function filter(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date_from' => 'nullable|date_format:Y-m-d',
            'date_to' => 'nullable|date_format:Y-m-d'
        ]);
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        
        $customerId = $id;
        $lotteries = DB::table('customer_lotteries')
                                ->join('customer_lotteries_slave','customer_lotteries.id','=','customer_lotteries_slave.customer_lottery_id')
                                ->where('customer_lotteries.customer_id',$customerId)
                                ->select('customer_lotteries_slave.game_date as date')
                                ->groupBy('customer_lotteries_slave.game_date')
                                ->orderBy('customer_lotteries_slave.game_date','DESC');

        $dateFrom = $request->date_from; 
        $dateTo = $request->date_to; 
        $referenceNumber = $request->reference_number; 
        $lotteryNumber  = $request->lottery_number; 
        
        if($dateFrom && $dateTo)
            $lotteries = $lotteries->whereBetween('customer_lotteries_slave.game_date',[$dateFrom, $dateTo]);
        elseif($dateFrom)
            $lotteries = $lotteries->where('customer_lotteries_slave.game_date','>=',$dateFrom);
        elseif($dateTo)
            $lotteries = $lotteries->where('customer_lotteries_slave.game_date','<=',$dateTo);

        if($referenceNumber)
            $lotteries = $lotteries->where('customer_lotteries.reference_number',$referenceNumber);

        if($lotteryNumber)
            $lotteries = $lotteries->where(function ($query) use ($lotteryNumber)
            {
                # code...
                $query->where('customer_lotteries.number_pattern', $lotteryNumber)
                    ->orWhere('customer_lotteries_slave.lottery_number', $lotteryNumber);
            });

        $lotteries = $lotteries->get();

        
        $lotteries->map(function ($lottery) use($customerId, $referenceNumber, $lotteryNumber)
        {
            # code...
            $lottery->day_name = Carbon::createFromFormat('Y-m-d', $lottery->date)->format('d M, l');

            //getting game list with lottery list
            $games = Brand::join('customer_lotteries_slave','customer_lotteries_slave.game_id','=','brands.id')
                            ->join('customer_lotteries','customer_lotteries_slave.customer_lottery_id','=','customer_lotteries.id')
                            ->distinct('game_name')
                            ->select('brands.name as game_name','brands.id as game_id')
                            ->where('customer_lotteries.customer_id',$customerId)
                            ->where('customer_lotteries_slave.game_date',$lottery->date);

            if($referenceNumber)
                $games = $games->where('customer_lotteries.reference_number',$referenceNumber);

            if($lotteryNumber)
                $games = $games->where(function ($query) use ($lotteryNumber)
                {
                    # code...
                    $query->where('customer_lotteries.number_pattern', $lotteryNumber)
                        ->orWhere('customer_lotteries_slave.lottery_number', $lotteryNumber);
                });
            $games = $games->get();

            $games->map(function($game) use($customerId, $lottery, $referenceNumber, $lotteryNumber){
                $lotteryDatas = Lottery::join('customer_lotteries_slave','customer_lotteries.id','=','customer_lotteries_slave.customer_lottery_id')
                                ->join('companies','customer_lotteries.company_id','=','companies.id')
                                ->where('customer_lotteries.customer_id',$customerId)
                                ->where('customer_lotteries_slave.game_date',$lottery->date)
                                ->where('customer_lotteries_slave.game_id',$game->game_id)
                                ->distinct('customer_lotteries.id')
                                ->select(
                                    'customer_lotteries.id',
                                    'customer_lotteries.number_pattern',
                                    'customer_lotteries.big_bet_amount',
                                    'customer_lotteries.small_bet_amount',
                                    'customer_lotteries.bet_type',
                                    'customer_lotteries.total_amount',
                                    'companies.commission',
                                    DB::raw("total_amount + (total_amount * companies.commission/100) AS net_amount"),
                                );
                if($referenceNumber)
                    $lotteryDatas = $lotteryDatas->where('customer_lotteries.reference_number',$referenceNumber);

                if($lotteryNumber)
                    $lotteryDatas = $lotteryDatas->where(function ($query) use ($lotteryNumber)
                    {
                        # code...
                        $query->where('customer_lotteries.number_pattern', $lotteryNumber)
                            ->orWhere('customer_lotteries_slave.lottery_number', $lotteryNumber);
                    });
                $lotteryDatas = $lotteryDatas->get();

                $game->lotteries = $lotteryDatas;
            });
            $lottery->games = $games;

        });
        return $this->sendResponse($lotteries, 'Lotteries retrieved successfully.');
    }

    public function destroy(Request $request)
    {
        $id=$request->id; 
        if($id!="") {
            //if (DB::table('orders')->where('finalized', 1)->exists()) {
            if(DB::table('customer_lotteries_slave')->where('id',$id)->exists()){
                $data = DB::table('customer_lotteries_slave')->where('id',$id)->delete();
                return $this->sendResponse([], 'Deleted successfully.');
            }else{
                return $this->sendError('Something Wrong'); 
            }
           
        }else{
            return $this->sendError('Something Wrong');  
        }
       
    }
   
   
    public function lotterySlaveList(Request $request)
    {
        # code...
        $customerLottteryIds = Lottery::where('reference_number', $request->reference_number)->pluck('id');
        
        $lotteries = DB::table('customer_lotteries_slave')
                                ->whereIn('customer_lottery_id', $customerLottteryIds)
                                ->select('customer_lotteries_slave.game_date as date')
                                ->groupBy('customer_lotteries_slave.game_date')
                                ->orderBy('customer_lotteries_slave.game_date','DESC');


        $lotteries = $lotteries->get();

        
        $lotteries->map(function ($lottery) use( $customerLottteryIds)
        {
            # code...
            $lottery->day_name = Carbon::createFromFormat('Y-m-d', $lottery->date)->format('d M, l');

            //getting game list with lottery list
            $games = Brand::join('customer_lotteries_slave','customer_lotteries_slave.game_id','=','brands.id')
                            ->distinct('game_name')
                            ->select('brands.name as game_name','brands.id as game_id')
                            ->whereIn('customer_lotteries_slave.customer_lottery_id',$customerLottteryIds)
                            ->where('customer_lotteries_slave.game_date',$lottery->date);

            $games = $games->get();

            $games->map(function($game) use($lottery, $customerLottteryIds){
                $lotteryDatas = DB::table('customer_lotteries_slave')
                                ->where('customer_lotteries_slave.game_date',$lottery->date)
                                ->where('customer_lotteries_slave.game_id',$game->game_id)
                                ->whereIn('customer_lottery_id',$customerLottteryIds)
                                ->distinct('customer_lotteries_slave.lottery_number')
                                ->select(
                                    'customer_lotteries_slave.id',
                                    'customer_lotteries_slave.customer_lottery_id',
                                    'customer_lotteries_slave.game_id',
                                    'customer_lotteries_slave.game_date',
                                    'customer_lotteries_slave.lottery_number',
                                    'customer_lotteries_slave.amount',
                                    'customer_lotteries_slave.status',
                                    'customer_lotteries_slave.net_amount',
                                    'customer_lotteries_slave.commission',
                                );
                
                $lotteryDatas = $lotteryDatas->get();

                $game->lotteries = $lotteryDatas;
            });
            $lottery->games = $games;

        });
        return $this->sendResponse($lotteries, 'Lottery slave retrieved successfully.');


    }
    public function changeStatus(Request $request)
    {
        $refid=$request->id; 
        if($refid!="") {
            if(DB::table('customer_lotteries')->where('reference_number',$refid)->exists()){
                $data = DB::table('customer_lotteries')->where('reference_number', $refid)->update(['status' => 'active']);
                return $this->sendResponse([], 'Updated successfully.');
            }else{
                return $this->sendError('Something Wrong'); 
            }
        }else{
            return $this->sendError('Something Wrong');  
        }
       
    }
    
    public function showRefId(Request $request, $customerId)
    {
        $validator = Validator::make($request->all(), [
            'flag' => 'required|in:settled,unsettled'

        ],[
            'flag.in' => 'flag must be settled or unsettled'
        ]);
        $flag = $request->flag;
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        if(isset($request->limit)){
            $lotteries = DB::table('customer_lotteries')
                ->join('customer_lotteries_slave','customer_lotteries.id','=','customer_lotteries_slave.customer_lottery_id')
                ->where('customer_lotteries.customer_id',$customerId)
                ->select('customer_lotteries.reference_number as id','customer_lotteries.reference_number as text')
                ->groupBy('customer_lotteries.reference_number');
        }else{
            $lotteries = DB::table('customer_lotteries')
                ->join('customer_lotteries_slave','customer_lotteries.id','=','customer_lotteries_slave.customer_lottery_id')
                ->where('customer_lotteries.customer_id',$customerId)
                ->select('customer_lotteries.reference_number as id','customer_lotteries.reference_number as text')
                ->groupBy('reference_number');
        }
        $flagString = '';
        if($flag == 'settled')
            $flagString = 'Finished';
        elseif($flag == 'unsettled')
            $flagString = 'Inprocess';
        if($flagString)
        $lotteries = $lotteries->where('customer_lotteries_slave.status', $flagString);
        if(isset($request->limit)){
            $lotteries= $lotteries->latest('customer_lotteries.id')->first();
        }else{
            $lotteries= $lotteries->get();
        }
        return $this->sendResponse($lotteries, 'Lotteries retrieved successfully.');
    }
}