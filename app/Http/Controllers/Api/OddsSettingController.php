<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Http\Request;
use DB;

class OddsSettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies  = Company::where('companies.status', '=', 'enabled')
                        ->select('companies.id','companies.name')
                        ->orderBy('companies.name', 'ASC')->get();
        $data['company'] = $companies;
        return $this->sendResponse($data, 'Comapanies retrieved successfully.');
    }


    public function rateSettingDetail($id)
    {
       
        $rate_setting_detail = Brand::join('brand_company','brands.id','=','brand_company.brand_id')
                                        ->select('brands.id','brands.name','first_prize','second_prize','third_prize','special_prize','consolation_prize')
                                        ->whereCompanyId($id)
                                        ->where('brands.status', 'enabled')
                                        ->get();
        return $this->sendResponse($rate_setting_detail, 'Rate setting detail retrieved successfully.');
    }

    public function commissionSettingDetail($id)
    {
       
        $rate_setting_detail = Brand::join('brand_company','brands.id','=','brand_company.brand_id')
                                        ->select('brands.id','brands.name','prize_drop_off','max_allowed_limit','decremental_percentage_value')
                                        ->whereCompanyId($id)
                                        ->where('brands.status', 'enabled')
                                        ->get();
        return $this->sendResponse($rate_setting_detail, 'commission setting detail retrieved successfully.');
    }

    public function popularNumberList(Request $request)
    {
        $populerNumberSettings = DB::table('populer_number_settings as pns')->select('pns.id','pns.populer_number','companies.name as company_name','brands.name as brand_name')
                            ->leftJoin('companies', 'companies.id', '=', 'pns.entity')
                            ->leftJoin('brands', 'brands.id', '=', 'pns.game_plane')->paginate(DEFAULT_PAGINATION_LIMIT)->toArray();

        $data['current_page'] = $populerNumberSettings['current_page'];
        $data['last_page'] = $populerNumberSettings['last_page'];
        $data['per_page'] = $populerNumberSettings['per_page'];
        $data['total'] = $populerNumberSettings['total'];
        $data['data'] = $populerNumberSettings['data'];
        return $this->sendResponse($data, 'popular setting detail retrieved successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
