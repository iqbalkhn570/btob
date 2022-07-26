<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile =  new Profile;
        $profile = $profile->Where('id', '=', Auth::user()->id)->first();
        //if($profile->first() !=null){
           // $profile = $profile->first();
        //}
      
        return view('admin.profile')->with('profile', $profile);
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
    {//echo "<pre>";
		//print_r($request);die;
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                //'email' => ['required','string','email','max:255'],
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'contact_number' => ['required'],
                
            ]);
           

            if (!$validatedData->fails())
            {
                $profile = new Profile;
                if($profile->first() !=null){
                    $profile = $profile->first();
                }
				$profile = profile::find($request->hidden_id);
                if($request->hasFile('image'))
                {//echo "here";die;
                    $image = $request->file('image');
                    $image_name = time().'-image.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/admin/images/user');
                    $image->move($destinationPath, $image_name);
                    $profile->image = $image_name;
                 }
                
                $profile->name = $request->name;
               // $profile->email = $request->email;
                $profile->contact_number = $request->contact_number;
				//$profile->image = $image_name;

                if($profile->save()){
                    
                    $request->session()->flash('message', 'Profile has been updated.');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('admin_profile'));
                }else{
                    $validatedData->errors()->add('', 'There is something error, profile does not update');
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
