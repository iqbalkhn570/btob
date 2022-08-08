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

        DB::beginTransaction();
        
        try {
            //code...
            $dates = $request->dates;
            $games = $request->games;
            $datas = $request->datas;
            $referenceNum = Str::uuid()->toString().'/'.Carbon::now()->year.'/REF';

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
                            }else{
                                $slaveData['amount'] = @$value['amount']/count($temp);
                            }
                            
                            foreach($temp as $key=>$row){
                                //die('khan');
                                $slaveData['lottery_number'] = $row;
                                DB::table('customer_lotteries_slave')->insert($slaveData);
                            }
                        }else{
                            $slaveData['amount'] = @$value['amount'];
                            DB::table('customer_lotteries_slave')->insert($slaveData);
                        }
                       // }

                    }
                    
                }
            }

        } catch (\Throwable $th) {
           
            return $this->sendError('Store data error.',$th);       

        }
        DB::commit();
        return $this->sendResponse([], 'Lottery created successfully.');
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

   
   
    
    
}