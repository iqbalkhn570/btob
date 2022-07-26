<?php

namespace App\Http\Controllers\admin;

use App\Models\UndertakeSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class UndertakeLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        
        $this->middleware('permission:undertake-limit-list|undertake-limit-create|undertake-limit-edit|undertake-limit-delete', ['only' => ['index','show']]);
        $this->middleware('permission:undertake-limit-create', ['only' => ['create','store']]);
        $this->middleware('permission:undertake-limit-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:undertake-limit-delete', ['only' => ['destroy']]);

    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $setting =  new UndertakeSetting;
        if($setting->first() !=null){
            $setting = $setting->first();
        }
        
      $query = UndertakeSetting::Sortable()->Select('*');
        
                $query = $query->Where('id','=',2);

        $setting2 = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
        return view('admin.undertake_limit')->with(array('setting'=> $setting,'setting2'=> $setting2));
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
                'sm_u_usd_amnt' => ['required'],
                'sm_u_myr_amnt' => ['required'],
                'sm_u_thb_amnt' => ['required'],
                'sm_u_vnd_amnt' => ['required'],
                'sm_u_sgd_amnt' => ['required'],
                'ma_u_usd_amnt' => ['required'],
                'ma_u_myr_amnt' => ['required'],
                'ma_u_thb_amnt' => ['required'],
                'ma_u_vnd_amnt' => ['required'],
                'ma_u_sgd_amnt' => ['required'],
                'a_u_usd_amnt' => ['required'],
                'a_u_myr_amnt' => ['required'],
                'a_u_thb_amnt' => ['required'],
                'a_u_vnd_amnt' => ['required'],
                'a_u_sgd_amnt' => ['required'],
                
            ]);
            if (!$validatedData->fails())
            {
                $setting =  UndertakeSetting::find('1');
                
                
                $setting->sm_u_usd_amnt = $request->sm_u_usd_amnt;
                $setting->sm_u_myr_amnt = $request->sm_u_myr_amnt;
                $setting->sm_u_thb_amnt = $request->sm_u_thb_amnt;
                $setting->sm_u_vnd_amnt = $request->sm_u_vnd_amnt;
                $setting->sm_u_sgd_amnt = $request->sm_u_sgd_amnt;
                $setting->ma_u_usd_amnt = $request->ma_u_usd_amnt;
                $setting->ma_u_myr_amnt = $request->ma_u_myr_amnt;
                $setting->ma_u_thb_amnt = $request->ma_u_thb_amnt;
                $setting->ma_u_vnd_amnt = $request->ma_u_vnd_amnt;
                $setting->ma_u_sgd_amnt = $request->ma_u_sgd_amnt;
                $setting->a_u_usd_amnt = $request->a_u_usd_amnt;
                $setting->a_u_myr_amnt = $request->a_u_myr_amnt;
                $setting->a_u_thb_amnt = $request->a_u_thb_amnt;
                $setting->a_u_vnd_amnt = $request->a_u_vnd_amnt;
                $setting->a_u_sgd_amnt = $request->a_u_sgd_amnt;
                
               
                if($setting->save()){
                    $request->session()->flash('message', 'Setting has been saved');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('undertake_limit'));
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
                
                'sm_u_usd_amnt' => ['required'],
                'sm_u_myr_amnt' => ['required'],
                'sm_u_thb_amnt' => ['required'],
                'sm_u_vnd_amnt' => ['required'],
                'sm_u_sgd_amnt' => ['required'],
                'ma_u_usd_amnt' => ['required'],
                'ma_u_myr_amnt' => ['required'],
                'ma_u_thb_amnt' => ['required'],
                'ma_u_vnd_amnt' => ['required'],
                'ma_u_sgd_amnt' => ['required'],
                'a_u_usd_amnt' => ['required'],
                'a_u_myr_amnt' => ['required'],
                'a_u_thb_amnt' => ['required'],
                'a_u_vnd_amnt' => ['required'],
                'a_u_sgd_amnt' => ['required'],
                
            ]);
            if (!$validatedData->fails())
            {
                
                $setting =  UndertakeSetting::find('2');
                
                $setting->sm_u_usd_amnt = $request->sm_u_usd_amnt;
                $setting->sm_u_myr_amnt = $request->sm_u_myr_amnt;
                $setting->sm_u_thb_amnt = $request->sm_u_thb_amnt;
                $setting->sm_u_vnd_amnt = $request->sm_u_vnd_amnt;
                $setting->sm_u_sgd_amnt = $request->sm_u_sgd_amnt;
                $setting->ma_u_usd_amnt = $request->ma_u_usd_amnt;
                $setting->ma_u_myr_amnt = $request->ma_u_myr_amnt;
                $setting->ma_u_thb_amnt = $request->ma_u_thb_amnt;
                $setting->ma_u_vnd_amnt = $request->ma_u_vnd_amnt;
                $setting->ma_u_sgd_amnt = $request->ma_u_sgd_amnt;
                $setting->a_u_usd_amnt = $request->a_u_usd_amnt;
                $setting->a_u_myr_amnt = $request->a_u_myr_amnt;
                $setting->a_u_thb_amnt = $request->a_u_thb_amnt;
                $setting->a_u_vnd_amnt = $request->a_u_vnd_amnt;
                $setting->a_u_sgd_amnt = $request->a_u_sgd_amnt;
               
               
                if($setting->save()){
                    $request->session()->flash('message', 'Setting has been saved');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('undertake_limit'));
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
