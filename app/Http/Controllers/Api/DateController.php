<?php
namespace App\Http\Controllers\Api;
     
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;
use Carbon\Carbon;

class DateController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $count = 7;
            $dates = [];
            $date = Carbon::now();
            for ($i = 0; $i < $count; $i++) {
                $mainDate = $date->addDay();
                if($mainDate->format('l') == 'Saturday' || $mainDate->format('l') == 'Sunday' || $mainDate->format('l') == 'Wednesday'){
                    $dates[] = $mainDate->format('l, d M');
                }
            }
            return $this->sendResponse($dates, 'Dates retrieved successfully.');
        
    }

    
}
