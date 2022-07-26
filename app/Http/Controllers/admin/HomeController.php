<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Company;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
         
         
        $query = new Company;
		$query = $query->Where('status','enabled');
        $data = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
        $selectBrand = $request->brands;
       // dd($query);
        return view('admin.home')->with(array('company'=>$data,'selectCountry'=>$selectBrand));
    }
}
