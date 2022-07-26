<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




   


use App\Rules\MatchOldPassword;

use Illuminate\Support\Facades\Hash;


  

class ChangepasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile =  new Profile;
        if($profile->first() !=null){
            $profile = $profile->first();
        }
      
        return view('admin.changepassword')->with('profile', $profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
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
    public function update(Request $request, Profile $profile)
    {	
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'current_password' => ['required', new MatchOldPassword],

            //'new_password' => ['required'],
            'new_password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*)(?=.*\d).+$/',


            'new_confirm_password' => ['same:new_password'],

            ]);
           

            if (!$validatedData->fails())
            {
                $profile = new Profile;
                if($profile->first() !=null){
                    $profile = $profile->first();
                }
				$profile = profile::find($request->hidden_id);
                
                $profile->password = Hash::make($request->new_password);
				//$profile->image = $image_name;

                if($profile->save()){
                    
                    $request->session()->flash('message', 'Password has been updated.');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('admin_change_password'));
                }else{
                    $validatedData->errors()->add('', 'There is something error, password does not update');
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
