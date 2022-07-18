<?php

namespace App\Http\Controllers\admin;

use App\Models\OddsSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class OddsSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
        $this->middleware('permission:odds-setting-list|odds-setting-create|odds-setting-edit|odds-setting-delete', ['only' => ['index','show']]);
        $this->middleware('permission:odds-setting-create', ['only' => ['create','store']]);
        $this->middleware('permission:odds-setting-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:odds-setting-delete', ['only' => ['destroy']]);

    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $setting =  new OddsSetting;
        if($setting->first() !=null){
            $setting = $setting->first();
        }
        
      $query = OddsSetting::Sortable()->Select('*');
        
                $query = $query->Where('id','=',2);

        $setting2 = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
        return view('admin.undertake_setting')->with(array('setting'=> $setting,'setting2'=> $setting2));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'c_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                
            ]);
            if (!$validatedData->fails())
            {
                $setting =  OddsSetting::find('1');
                
                $setting->c_u_usd = $request->c_u_usd;
                $setting->c_u_myr = $request->c_u_myr;
                $setting->c_u_thb = $request->c_u_thb;
                $setting->c_u_vnd = $request->c_u_vnd;
                $setting->c_u_sgd = $request->c_u_sgd;
                $setting->sm_u_usd = $request->sm_u_usd;
                $setting->sm_u_myr = $request->sm_u_myr;
                $setting->sm_u_thb = $request->sm_u_thb;
                $setting->sm_u_vnd = $request->sm_u_vnd;
                $setting->sm_u_sgd = $request->sm_u_sgd;
                $setting->ma_u_usd = $request->ma_u_usd;
                $setting->ma_u_myr = $request->ma_u_myr;
                $setting->ma_u_thb = $request->ma_u_thb;
                $setting->ma_u_vnd = $request->ma_u_vnd;
                $setting->ma_u_sgd = $request->ma_u_sgd;
                $setting->a_u_usd = $request->a_u_usd;
                $setting->a_u_myr = $request->a_u_myr;
                $setting->a_u_thb = $request->a_u_thb;
                $setting->a_u_vnd = $request->a_u_vnd;
                $setting->a_u_sgd = $request->a_u_sgd;
                if($request->c_u_usd+$request->sm_u_usd+$request->ma_u_usd+$request->a_u_usd>100){
                    $request->session()->flash('message', 'USD column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_myr+$request->sm_u_myr+$request->ma_u_myr+$request->a_u_myr>100){
                    $request->session()->flash('message', 'MYR column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_thb+$request->sm_u_thb+$request->ma_u_thb+$request->a_u_thb>100){
                    $request->session()->flash('message', 'THB column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_vnd+$request->sm_u_vnd+$request->ma_u_vnd+$request->a_u_vnd>100){
                    $request->session()->flash('message', 'VND column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_sgd+$request->sm_u_sgd+$request->ma_u_sgd+$request->a_u_sgd>100){
                    $request->session()->flash('message', 'SGD column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
               
                if($setting->save()){
                    $request->session()->flash('message', 'Setting has been saved');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('undertake_setting'));
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

    public function save(Request $request)
    {
        
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'c_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'c_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'sm_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'ma_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_usd' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_myr' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_thb' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_vnd' => ['required', 'integer','nullable', 'between:0,100'],
                'a_u_sgd' => ['required', 'integer','nullable', 'between:0,100'],
                
            ]);
            if (!$validatedData->fails())
            {
                
                $setting =  OddsSetting::find('2');
                $setting->c_u_usd = $request->c_u_usd;
                $setting->c_u_myr = $request->c_u_myr;
                $setting->c_u_thb = $request->c_u_thb;
                $setting->c_u_vnd = $request->c_u_vnd;
                $setting->c_u_sgd = $request->c_u_sgd;
                $setting->sm_u_usd = $request->sm_u_usd;
                $setting->sm_u_myr = $request->sm_u_myr;
                $setting->sm_u_thb = $request->sm_u_thb;
                $setting->sm_u_vnd = $request->sm_u_vnd;
                $setting->sm_u_sgd = $request->sm_u_sgd;
                $setting->ma_u_usd = $request->ma_u_usd;
                $setting->ma_u_myr = $request->ma_u_myr;
                $setting->ma_u_thb = $request->ma_u_thb;
                $setting->ma_u_vnd = $request->ma_u_vnd;
                $setting->ma_u_sgd = $request->ma_u_sgd;
                $setting->a_u_usd = $request->a_u_usd;
                $setting->a_u_myr = $request->a_u_myr;
                $setting->a_u_thb = $request->a_u_thb;
                $setting->a_u_vnd = $request->a_u_vnd;
                $setting->a_u_sgd = $request->a_u_sgd;
                if($request->c_u_usd+$request->sm_u_usd+$request->ma_u_usd+$request->a_u_usd>100){
                    $request->session()->flash('message', 'USD column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_myr+$request->sm_u_myr+$request->ma_u_myr+$request->a_u_myr>100){
                    $request->session()->flash('message', 'MYR column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_thb+$request->sm_u_thb+$request->ma_u_thb+$request->a_u_thb>100){
                    $request->session()->flash('message', 'THB column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_vnd+$request->sm_u_vnd+$request->ma_u_vnd+$request->a_u_vnd>100){
                    $request->session()->flash('message', 'VND column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
                if($request->c_u_sgd+$request->sm_u_sgd+$request->ma_u_sgd+$request->a_u_sgd>100){
                    $request->session()->flash('message', 'SGD column should not more than 100');
                    $request->session()->flash('alert-class', 'alert-warning');
                    return redirect(route('undertake_setting')); 
                }
               
                if($setting->save()){
                    $request->session()->flash('message', 'Setting has been saved');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('undertake_setting'));
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

  

    
    

    
}
