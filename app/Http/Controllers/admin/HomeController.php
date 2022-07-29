<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
         
        
        $query = new Company;
		$query = $query->Where('status','enabled');
        $data = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
        $selectBrand = $request->brands??20;
        
        if(!$request->filter_date_range){
            $dateFrom  = date('Y-m-d');
            $dateTo  = date('Y-m-d');
        }else{
            $tempDateRange = explode("-",$request->filter_date_range);
            $dateFrom  = date('Y-m-d', strtotime($tempDateRange[0]));
            $dateTo  = date('Y-m-d', strtotime($tempDateRange[1]));
        }

       
                      

                        $to = \Carbon\Carbon::parse($dateTo);
                        $from = \Carbon\Carbon::parse($dateFrom ); 
                        $days = $to->diffInDays($from) +1; 
                        $daysArr = [];
                        $turnoverArr = [];
                        $graphFor = 'Turnover';
                        if($days>1){
                            
                            for($i=1; $i<=$days ; $i++){
                                if($i==1){
                                    $tempDate = $from->format('Y-m-d'); 
                                }else{
                                    $tempDate = $from->addDays(1)->format('Y-m-d'); 
                                }
                                
                                $daysArr[] = $tempDate;
                                $dataturnoverGp = DB::table('mock_dashboard_table')
                                                ->select('*')
                                                ->where('bussiness_entity_id','=', $selectBrand)
                                               
                                                ->whereBetween('created_at', [$tempDate.' 00:00:00', $tempDate.' 23:59:59'])
                                                ->first(); 
                                              
                                              if(!is_null($dataturnoverGp)){
                                                if($request->chart_for =='turnover'){
                                                    $turnoverArr[] = $dataturnoverGp->turnover;
                                                }elseif($request->chart_for =='total_payout'){
                                                    $turnoverArr[] = $dataturnoverGp->total_payout;
                                                    $graphFor = 'total payout';
                                                }elseif($request->chart_for =='gross_gaming_revenue'){
                                                    $turnoverArr[] = $dataturnoverGp->gross_gaming_revenue;
                                                    $graphFor = 'gross gaming revenue';
                                                }elseif($request->chart_for =='largest_bets'){
                                                    $turnoverArr[] = $dataturnoverGp->largest_bets;
                                                    $graphFor = 'largest bets';
                                                }elseif($request->chart_for =='most_amount_bets'){
                                                    $turnoverArr[] = $dataturnoverGp->most_amount_bets;
                                                    $graphFor = 'most amount bets';
                                                }elseif($request->chart_for =='least_amount_bets'){
                                                    $turnoverArr[] = $dataturnoverGp->least_amount_bets;
                                                    $graphFor = 'least amount bets';
                                                }elseif($request->chart_for =='top_game_revenue'){
                                                    $turnoverArr[] = $dataturnoverGp->top_game_revenue;
                                                    $graphFor = 'top game revenue';
                                                }elseif($request->chart_for =='low_game_revenue'){
                                                    $turnoverArr[] = $dataturnoverGp->low_game_revenue;
                                                    $graphFor = 'low game revenue';
                                                }
                                                else{
                                                    $turnoverArr[] = $dataturnoverGp->turnover;
                                                    $graphFor = 'Turnover';
                                                }
                                                
                                              }else{
                                                $turnoverArr[] = 0;
                                              }           
                                    
                                      
                            }
                              
                        }
                        
                      // dd($turnoverArr);                
      

        $dashboardData = DB::table('mock_dashboard_table')
                ->select( DB::raw('SUM(turnover) as turnover'), DB::raw('SUM(total_payout) as total_payout'), DB::raw('SUM(gross_gaming_revenue) as gross_gaming_revenue'), DB::raw('SUM(largest_bets) as largest_bets'), DB::raw('SUM(most_amount_bets) as most_amount_bets'), DB::raw('SUM(least_amount_bets) as least_amount_bets'), DB::raw('SUM(top_game_revenue) as top_game_revenue'), DB::raw('SUM(low_game_revenue) as low_game_revenue'))
                ->where('bussiness_entity_id','=', $selectBrand)
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->groupBy('bussiness_entity_id')
                ->first();
        
        return view('admin.home')->with(array('company'=>$data,'selectCountry'=>$selectBrand,"dashboardData"=>$dashboardData,'daysArr'=>$daysArr,'turnoverArr'=>$turnoverArr,'graphFor'=>$graphFor));
    }
}