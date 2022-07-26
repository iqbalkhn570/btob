<?php

namespace App\Http\Controllers\admin;

use App\Models\Setting;
use App\Models\Company;
use App\Models\Brand;

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

        $this->search_action="odd-settings";

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

  
    public function oddSettings(Request $request)
    {
        $setting =  new Setting;
        if($setting->first() !=null){
            $setting = $setting->first();
        }
        $company = Company::Select('*');
        if( $request->search_term) {
            $company = $company->Where('name','LIKE', "%{$request->search_term}%");
            $this->search="Yes";
        }
        $company = $company->Where('status', '=', 'enabled');
        $company = $company->orderBy('name', 'ASC')->paginate(0);
        $brand = Brand::Select('*');
        $brand = $brand->Where('status', '=', 'enabled');
        $brand = $brand->orderBy('name', 'ASC')->paginate(0);
      
        $companyStatus = Company::Select('*')->Where('status', '=', 'enabled')->orderBy('name', 'ASC')->get();
        $brandStatus = Brand::Select('*')->Where('status', '=', 'enabled')->orderBy('name', 'ASC')->get();
        foreach($companyStatus as $companyVal){
            foreach($brandStatus as $brandVal){
                if(!DB::table('brand_company')->where('company_id',$companyVal->id)->where('brand_id',$brandVal->id)->exists()){
                    $values = array('company_id' => $companyVal->id,'brand_id' => $brandVal->id);
                    DB::table('brand_company')->insert($values);
                }
            } 
        }

        $populerNumberSettings = DB::table('populer_number_settings as pns')->select('pns.id','pns.populer_number','companies.name as c_name','brands.name as b_name')
                            ->leftJoin('companies', 'companies.id', '=', 'pns.entity')
                            ->leftJoin('brands', 'brands.id', '=', 'pns.game_plane')->get();

        return view('admin.oddsettings.oddsettings')->with(array('setting' => $setting, 'company' => $company, 'brand' => $brand,'search_action'=>$this->search_action,'populerNumberSettings'=>$populerNumberSettings));
    }
    
    
  
    public function saveprizes(Request $request)
    {
        if($request->isMethod('post')) {
            foreach($request->brand_company_id as $brand_company_id){
                $values = array(
                                'first_prize' => $request->post("first_prize".$brand_company_id),
                                'second_prize' => $request->post("second_prize".$brand_company_id),
                                'third_prize' => $request->post("third_prize".$brand_company_id),
                                'special_prize' => $request->post("special_prize".$brand_company_id),
                                'consolation_prize' => $request->post("consolation_prize".$brand_company_id)
                            );
                DB::table('brand_company')->where('id',$brand_company_id)->update($values);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function savedropprizes(Request $request)
    {
        if($request->isMethod('post')) {
            foreach($request->brand_company_id as $brand_company_id){
                $values = array(
                                'prize_drop_off' => $request->post("prize_drop_off".$brand_company_id),
                                'max_allowed_limit' => $request->post("max_allowed_limit".$brand_company_id),
                                'decremental_percentage_value' => $request->post("decremental_percentage_value".$brand_company_id)
                            );
                DB::table('brand_company')->where('id',$brand_company_id)->update($values);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function getGameDetailsVal(Request $request)
    {
        $brand = Brand::Select('*');
        $brand = $brand->Where('status', '=', 'enabled');
        $brand = $brand->orderBy('name', 'ASC')->paginate(0);
        echo '<option value="">Please Select Game Plane</option>';
        foreach ($brand as $brandinfo){
            if(!DB::table("brand_company")->where("company_id",$request->slug)->where("brand_id",$brandinfo->id)->where("status","enabled")->exists()){
                $disabled = ' disabled ';
            }else{
                $disabled = ' ';
            }
            echo '<option '.$disabled.' value="'.$brandinfo->id.'">'.$brandinfo->name.'</option>';
        }
    }

    public function saveCommissionSettings(Request $request)
    {
        foreach($request->number_of as $number_of){
            $values = array(
                            'populer_number' => $request->post("populer_number".$number_of),
                            'entity' => $request->post("entity".$number_of),
                            'game_plane' => $request->post("game_plane".$number_of)
                        );
            DB::table('populer_number_settings')->insert($values);
        }
        $request->session()->flash('message', 'Setting has been saved');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect(url('admin/odd-settings?work=populer'));
    }

    public function updateCommissionSettings(Request $request)
    {
        if($request->isMethod('post')) {
            $values = array(
                            'populer_number' => $request->post("populer_number")
                        );
            if(DB::table('populer_number_settings')->where('id',$request->id)->update($values)){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }

    }
    public function onDeletePns(Request $request)
    {
        if(DB::table('populer_number_settings')->where('id',$request->id)->delete()){
            return redirect(url('admin/odd-settings?work=populer'));
        }
    }
    
    
}
