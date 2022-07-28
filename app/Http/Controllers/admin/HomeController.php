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
        
       //echo $dateFrom ."=====".$dateTo;
        // fetch data from table

        $dashboardData = DB::table('mock_dashboard_table')
                ->select( DB::raw('SUM(turnover) as turnover'), DB::raw('SUM(total_payout) as total_payout'), DB::raw('SUM(gross_gaming_revenue) as gross_gaming_revenue'), DB::raw('SUM(largest_bets) as largest_bets'), DB::raw('SUM(most_amount_bets) as most_amount_bets'), DB::raw('SUM(least_amount_bets) as least_amount_bets'), DB::raw('SUM(top_game_revenue) as top_game_revenue'), DB::raw('SUM(low_game_revenue) as low_game_revenue'))
                ->where('bussiness_entity_id','=', $selectBrand)
                ->whereBetween('created_at', [$dateFrom, $dateTo])
                ->groupBy('bussiness_entity_id')
                ->first();
        
        return view('admin.home')->with(array('company'=>$data,'selectCountry'=>$selectBrand,"dashboardData"=>$dashboardData));
    }
}