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
            try {
            $count = 7;
            $dates = [];
            $date = Carbon::now();
            for ($i = 0; $i < $count; $i++) {
                $mainDate = $date->addDay();
                if($mainDate->format('l') == 'Saturday' || $mainDate->format('l') == 'Sunday' || $mainDate->format('l') == 'Wednesday'){
                    $dates[] = $mainDate->format('l, d M');
                }
            }
            } catch (Exception $e) {
                $message = $e->getMessage();
                var_dump('Exception Message: '. $message);
                $code = $e->getCode();       
                var_dump('Exception Code: '. $code);
                $string = $e->__toString();       
                var_dump('Exception String: '. $string);
                exit;
            }
            return $this->sendResponse($dates, 'Dates retrieved successfully.');
        
    }
    
}
