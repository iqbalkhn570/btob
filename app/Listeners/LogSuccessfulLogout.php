<?php

namespace App\Listeners;

//use App\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
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
     * @param  \App\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if (!empty(auth()->user()->id)) {
        DB::table('activity_logs')
    ->where('uid',auth()->user()->id)
    ->orderBy('id','desc')
    ->take(1)
    ->update([
        'updated_at' => date('Y-m-d H:i:s')
    ]);

}

    }
}
