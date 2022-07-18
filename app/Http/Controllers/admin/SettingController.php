<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
        $this->middleware('permission:setting-list|setting-create|setting-edit|setting-delete', ['only' => ['index','show']]);
        $this->middleware('permission:setting-create', ['only' => ['create','store']]);
        $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:setting-delete', ['only' => ['destroy']]);

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting =  new Setting;
        if($setting->first() !=null){
            $setting = $setting->first();
        }
      
        return view('admin.setting')->with('setting', $setting);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo $request->instagram_status;die;
        
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'admin_email_id' => ['required', 'string','email', 'max:255'],
                'contact_address1' => ['required','string','max:255'],
                'contact_city' => ['required','string','max:255'],
                'contact_province' => ['required','string','max:255'],
                'contact_country' => ['required','string','max:255'],
                'contact_zip' => ['required','string','min:4','max:8'],
                'website_name' => ['required','string','max:255'],
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'meta_title' => ['max:100'],
                'meta_description' => ['max:200'],
                'meta_keywords' => ['max:200'],
                
            ]);
           

            if (!$validatedData->fails())
            {
                $setting = new Setting;
                if($setting->first() !=null){
                    $setting = $setting->first();
                }
                if($request->hasFile('logo'))
                { 
                    $image = $request->file('logo');
                    $image_name = time().'-logo.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->logo){
                        $old_image_path = public_path('/frontend/images/'.$setting->logo);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->logo = $image_name;
                }
                if($request->hasFile('instagram_icon'))
                { 
                    $image = $request->file('instagram_icon');
                    $image_name = time().'-instagram_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->instagram_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->instagram_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->instagram_icon = $image_name;
                }
                if($request->hasFile('youtube_icon'))
                { 
                    $image = $request->file('youtube_icon');
                    $image_name = time().'-youtube_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->youtube_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->youtube_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->youtube_icon = $image_name;
                }
                if($request->hasFile('facebook_icon'))
                { 
                    $image = $request->file('facebook_icon');
                    $image_name = time().'-facebook_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->facebook_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->facebook_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->facebook_icon = $image_name;
                }
                if($request->hasFile('pinterest_icon'))
                { 
                    $image = $request->file('pinterest_icon');
                    $image_name = time().'-pinterest_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->pinterest_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->pinterest_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->pinterest_icon = $image_name;
                }
                if($request->hasFile('twitter_icon'))
                { 
                    $image = $request->file('twitter_icon');
                    $image_name = time().'-twitter_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->twitter_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->twitter_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->twitter_icon = $image_name;
                }
                if($request->hasFile('qq_icon'))
                { 
                    $image = $request->file('qq_icon');
                    $image_name = time().'-qq_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->qq_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->qq_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->qq_icon = $image_name;
                }
                if($request->hasFile('skype_icon'))
                { 
                    $image = $request->file('skype_icon');
                    $image_name = time().'-skype_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->skype_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->skype_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->skype_icon = $image_name;
                }
                if($request->hasFile('telegram_icon'))
                { 
                    $image = $request->file('telegram_icon');
                    $image_name = time().'-telegram_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->telegram_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->telegram_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->telegram_icon = $image_name;
                }
                if($request->hasFile('whatsapp_icon'))
                { 
                    $image = $request->file('whatsapp_icon');
                    $image_name = time().'-whatsapp_icon.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/frontend/images');
                    $image->move($destinationPath, $image_name);
                    if( $setting->whatsapp_icon){
                        $old_image_path = public_path('/frontend/images/'.$setting->whatsapp_icon);
                        if(File::exists($old_image_path)){
                            File::delete($old_image_path);
                        }
                    }
                    $setting->whatsapp_icon = $image_name;
                }
                
                $setting->contact_address1 = $request->contact_address1;
                $setting->contact_address2 = $request->contact_address2;
                $setting->contact_city = $request->contact_city;
                $setting->contact_province = $request->contact_province;
                $setting->contact_country = $request->contact_country;
                $setting->contact_zip = $request->contact_zip;
                $setting->contact_phone1 = $request->contact_phone1;
                $setting->contact_phone2 = $request->contact_phone2;
                $setting->admin_email_id = $request->admin_email_id;
                $setting->contact_email_id = $request->contact_email_id;
                $setting->general_email_id = $request->general_email_id;
                $setting->website_name = $request->website_name;
                $setting->meta_title = $request->meta_title;
                $setting->meta_description = $request->meta_description;
                $setting->meta_keywords = $request->meta_keywords;
                $setting->instagram_link = $request->instagram_link;
                $setting->instagram_status = $request->instagram_status;
                $setting->facebook_link = $request->facebook_link;
                $setting->facebook_status = $request->facebook_status;
                $setting->youtube_link = $request->youtube_link;
                $setting->youtube_status = $request->youtube_status;
                $setting->pinterest_link = $request->pinterest_link;
                $setting->pinterest_status = $request->pinterest_status;
                $setting->twitter_link = $request->twitter_link;
                $setting->twitter_status = $request->twitter_status;
                $setting->qq_link = $request->qq_link;
                $setting->qq_status = $request->qq_status;
                $setting->skype_link = $request->skype_link;
                $setting->skype_status = $request->skype_status;
                $setting->telegram_link = $request->telegram_link;
                $setting->telegram_status = $request->telegram_status;
                $setting->whatsapp_link = $request->whatsapp_link;
                $setting->whatsapp_status = $request->whatsapp_status;


                
               
                if($setting->save()){
                    
                    $request->session()->flash('message', 'Setting has been saved');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('setting'));
                }else{
                    $validatedData->errors()->add('', 'There is something error, setting does not save');
                }
            }
            return redirect()
                    ->back()
                    ->withInput($request->all())
                    ->withErrors($validatedData);  
        }
        return redirect()
                    ->back()
                    ->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
