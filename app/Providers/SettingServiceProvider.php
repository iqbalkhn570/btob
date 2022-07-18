<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('settings')) {
            $setting =  new Setting;
            if($setting->first() !=null){
                $setting = $setting->first();
            }
          
            View::share('website_setting',$setting);
            View::share('website_name',$setting->website_name ? $setting->website_name: config('app.name'));

            View::share('currencySymbole','$');
        }
    }
}
