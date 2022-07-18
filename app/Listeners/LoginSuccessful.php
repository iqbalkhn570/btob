<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Location;
use Jenssegers\Agent\Agent;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {

        $agent = new Agent;

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
          $result = 'Mobile';
        }

        $desktopResult= $agent->isDesktop();
        if ($desktopResult) {
          $result = 'Desktop';
        }

        $tabletResult= $agent->isTablet();
        if ($tabletResult) {
          $result = 'Tablet';
        }

        $tabletResult= $agent->isPhone();
        if ($tabletResult) {
          $result = 'Phone';
        }  
    $ip = request()->ip();
    $data = \Location::get($ip);
if($data!=""){
  DB::table('activity_logs')->insert([
    'uid'    => auth()->user()->id,
    'source'   =>$result,
    'countryName'   => $data->countryName,
    'countryCode'   => $data->countryCode,
    'regionCode'   => $data->regionCode,
    'regionName'   => $data->regionName,
    'cityName'   => $data->cityName,
    'zipCode'   => $data->zipCode,
    'isoCode'   => $data->isoCode,
    'postalCode'   => $data->postalCode,
    'latitude'   => $data->latitude,
    'longitude'   => $data->longitude,
    'metroCode'   => $data->metroCode,
    'areaCode'   => $data->areaCode,
    'timezone'   => $data->timezone,
    'driver'   => $data->driver,
    'ip'       => $data->ip,
    'created_at'       => date('Y-m-d H:i:s')
]);
}
    
    }
}
