<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use App\Exports\ResultsExport;
use App\Imports\ResultsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
	 public function __construct()
    {
        $this->heading="Result";
		$this->add_action="result_add";
		$this->edit_action="result_edit";
		$this->delete_action="admin_result_delete";
		$this->status_action="admin_result_changeStatus";
		$this->search_action="result";
        $this->import_action="result_import";
        $this->import_sample_action="result_sample_file";
        $this->show_action="result_show";
		$this->folder="results";
        $this->search="No";
        $this->middleware('permission:lottery-list|lottery-create|lottery-edit|lottery-delete', ['only' => ['index','show']]);
        $this->middleware('permission:lottery-create', ['only' => ['create','store']]);
        $this->middleware('permission:lottery-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:lottery-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   //DB::enableQueryLog();
        $query = Result::Sortable()->select('results.*', 'brands.name');
        if ($request->search_term) {
        if(Auth::user()->role_id==1 || Auth::user()->role_id==2){
            $query = $query->withTrashed()->Where('name', 'LIKE', "%{$request->search_term}%");
        $this->search = "Yes";

        }else{
            $query = $query->Where('name', 'LIKE', "%{$request->search_term}%");
            $this->search = "Yes";
        }
        }
        if( !empty($request->product_id)) {
            $query = $query->Where('product_id', $request->product_id);
        }
        if( !empty($request->brand_id)) {
            $query = $query->Where('brand_id', $request->brand_id);
        }
        if( !empty($request->brand_id)) {
            $query = $query->Where('brand_id', $request->brand_id);
        }
        if( !empty($request->date_from) && !empty($request->date_to)) {
            $startDate = Carbon::createFromFormat('m/d/Y', $request->date_from);
            $endDate = Carbon::createFromFormat('m/d/Y', $request->date_to);
            $query = $query->whereDate('fetching_date_new', '>=', $startDate);
            $query = $query->whereDate('fetching_date_new', '<=', $endDate);
        }
$query=$query->join('brands', 'results.brand_id', '=', 'brands.id');
		//$query = $query->Where('status','enabled');
        $data = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
       // var_dump($data, DB::getQueryLog());
      // dd(DB::getQueryLog());
        $products = Product::Select('*');
        $products = $products->Where('status','enabled');
        $products = $products->orderBy('id', 'ASC')->paginate(0);
        $brands = Brand::Select('*');
        $brands = $brands->Where('status','enabled');
        $brands = $brands->orderBy('id', 'ASC')->paginate(0);
        return view('admin.'.$this->folder.'.list')->with(array('brands'=>$brands,'products'=>$products,'data'=>$data,'search'=>$this->search,'heading'=>$this->heading,'add_action'=>$this->add_action,'edit_action'=>$this->edit_action,'show_action'=>$this->show_action,'delete_action'=>$this->delete_action,'status_action'=>$this->status_action,'search_action'=>$this->search_action));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Result;
        $brands = Brand::Select('*');
        $brands = $brands->Where('status','enabled');
        $brands = $brands->orderBy('id', 'ASC')->paginate(0);
        return view('admin.'.$this->folder.'.add')->with(array('brands'=>$brands,'data'=>$data,'heading'=>$this->heading,'search_action'=>$this->search_action));
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
                //'date_from' => 'required',
                'brand_id' => 'required',

                'fetching_date' =>  [
                    'required', 
                    Rule::unique('results')
                           ->where('brand_id', $request->brand_id)
                ],
                'reference_number' => 'required',
                'prize1' => 'required|numeric',
                'prize2' => 'required|numeric',
                'prize3' => 'required|numeric',
                'special1' => 'required|numeric',
                'special2' => 'required|numeric',
                'special3' => 'required|numeric',
                'special4' => 'required|numeric',
                'special5' => 'required|numeric',
                'special6' => 'required|numeric',
                'special7' => 'required|numeric',
                'special8' => 'required|numeric',
                'special9' => 'required|numeric',
                'special10' => 'required|numeric',
                'consolation1' => 'required|numeric',
                'consolation2' => 'required|numeric',
                'consolation3' => 'required|numeric',
                'consolation4' => 'required|numeric',
                'consolation5' => 'required|numeric',
                'consolation6' => 'required|numeric',
                'consolation7' => 'required|numeric',
                'consolation8' => 'required|numeric',
                'consolation9' => 'required|numeric',
                'consolation10' => 'required|numeric'
            ],
            [
                'fetching_date.unique' => 'Data already exist for selected date and game.',
            ]);

            if (!$validatedData->fails())
            {
                $date=date_create($request->fetching_date);
                $result_date=date_format($date,"D d-m-Y");
                $fetching_date_new=date_format($date,"Y-m-d");
                
                $data = new result;
                $data->result_date = $result_date;
                $data->fetching_date_new = $fetching_date_new;
                $data->fetching_date=$request->fetching_date;
                $data->brand_id = $request->brand_id;
                $data->product_id = 4;
                $data->reference_number = $request->reference_number;
                $data->prize1 = $request->prize1;
                $data->prize2 = $request->prize2;
                $data->prize3 = $request->prize3;
                $data->special1 = $request->special1;
                $data->special2 = $request->special2;
                $data->special3 = $request->special3;
                $data->special4 = $request->special4;
                $data->special5 = $request->special5;
                $data->special6 = $request->special6;
                $data->special7 = $request->special7;
                $data->special8 = $request->special8;
                $data->special9 = $request->special9;
                $data->special10 = $request->special10;
                $data->consolation1 = $request->consolation1;
                $data->consolation2 = $request->consolation2;
                $data->consolation3 = $request->consolation3;
                $data->consolation4 = $request->consolation4;
                $data->consolation5 = $request->consolation5;
                $data->consolation6 = $request->consolation6;
                $data->consolation7 = $request->consolation7;
                $data->consolation8 = $request->consolation8;
                $data->consolation9 = $request->consolation9;
                $data->consolation10 = $request->consolation10;
                if($data->save()){
                    $request->session()->flash('message', $this->heading.' added successfully');
                    $request->session()->flash('alert-class', 'alert-success');
					return redirect(route($this->search_action));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, result $data)
    {
        $data = new result;
        $data = $data->findOrFail($request->id);
        return view('admin.'.$this->folder.'.add')->with(array('data'=>$data,'heading'=>$this->heading,'search_action'=>$this->search_action));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, result $data)
    {
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'name' => 'required|max:255|unique:results,name,' . $request->id,
            ]);

            if (!$validatedData->fails() )
            { 
                $data =  result::find($request->id);
                $data->name = $request->name;
                $data->slug = Str::slug($request->name,'-');
				
                if($data->save()){
                    $request->session()->flash('message', $this->heading.' updated successfully');
                    $request->session()->flash('alert-class', 'alert-success');
					return redirect(route($this->search_action)); 

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
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, result $data)
    {
        $result = array('status'=>0, 'message'=>"");
        if($request->isMethod('get')) {
            $data =  Result::find($request->id);
           if($data->delete()){
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $request->session()->flash('message', $this->heading.' has been deleted successfully');
            $request->session()->flash('alert-class', 'alert-success');
            return redirect()->back(); 
           }
        }
        $request->session()->flash('message', $this->heading.' has not deleted');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back(); 
    }

   
    public function changeStatus(Request $request){
        $result = array('status'=>0, 'message'=>"");
        $status = ($request->status == 'enabled'? 'disabled': 'enabled');
        $data =  result::find($request->id);
        $data->status = $status;
           if($data->save()){
            $request->session()->flash('message', $this->heading." has been ".$status);
            $request->session()->flash('alert-class', 'alert-success');
            return redirect()->back();
           }
        
        $request->session()->flash('message', $this->heading.' has not deleted');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back(); 
       
    }
     /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ResultsExport, 'results.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importPage()
    {
        return view('admin.'.$this->folder.'.import')->with(array('import_sample_action'=>$this->import_sample_action,'import_action'=>$this->import_action,'heading'=>$this->heading));
    }
    public function import1(Request $request) 
    {
        Excel::import(new ResultsImport,request()->file('select_file'));
               
        //return back();
        $request->session()->flash('message', $this->heading." has been imported successfully");
        $request->session()->flash('alert-class', 'alert-success');
        return redirect()->back();
    }
    /**
     * Function to import banks
     */
    public function import(Request $request){
        $validatedData = Validator::make($request->all(), [
            'select_file'   => 'required|mimes:xls,xlsx'
        ]);
        if (!$validatedData->fails() )
        { 
            $file = $request->file('select_file')->store('import/result');/* file will save in storage/import/bank folder */
            
            $import = new ResultsImport;
            /* get excell data in array */
            $array_data = $import->toArray($file);
            if(count($array_data[0])  < 2 ){
                $validatedData->errors()->add('', 'The xlsx file you are importing is blank. ');
                return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validatedData); 
            }
            /**
             * Get header columns array
             */
           
            $headers = $array_data[0][0];
            foreach($headers as $key=> $head){
                if(!empty($head)){
                 $header_columns[$head] = $key ;
                }
            } 
            //dd($header_columns);
           // if($headers[''])
           // $header_columns = array_flip($headers);
            
            $updatedRows = 0;
            $insertedRows = 0;
            $totalRows = 0;
            foreach($array_data as $rows){
                foreach($rows as $key=>$row){
                   // echo $header_columns['name'];
                   // print_r($row);die;
                    if($key != 0){
                        $totalRows++;
                        $data_array = array(
                            'name' => $row['name'],
                            'slug' => Str::slug($row['name']),
                            'status' => isset($row['status']) ? $row['status'] : "enabled",
                            'created_at' => Carbon::now()
                        );
                        if( !empty($row['name']) ){
                            $result =  Result::where('name', $row['name']);
                            if($result->count() == 1){
                            // $data_array['updated_at'] = Carbon::now();
                                /* Update Row */
                                $result->update($data_array);
                                $updatedRows++;
                            }else{
                            // $data_array['created_at'] = Carbon::now();
                                /* Insert Row */
                                $result->insert($data_array);
                                $insertedRows++;
                            }
                        }else{
                            $validatedData->errors()->add('', 'There is an error at row no. '.$totalRows);
                        }
                      
                    }
                }
            }
            /**
             * Delete file from storage
             */
           // Storage::delete($file);
           
            //if(Excel::import(new BankImport,$file)){
               
                $request->session()->flash('message', 'Excel data imported successfully. Updated Rows :'.$updatedRows.' Inserted Rows :'.$insertedRows);
                $request->session()->flash('alert-class', 'alert-success');
            //}
                
            
        }
        return redirect()
        ->back()
        ->withInput($request->all())
        ->withErrors($validatedData); 

       
    }
   
    public function downloadSample(Request $request){
        $filename = 'result-sample-excel.xlsx';
        $path = public_path('admin/samples/'.$filename);

        // Download file with custom headers
        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
    public function show(Request $request, Result $data)
    {
        $data = new Result;
        $data = $data->findOrFail($request->id);
        return view('admin.'.$this->folder.'.show')->with(array('data'=>$data,'heading'=>$this->heading,'search_action'=>$this->search_action));
    }
    public function restore(Request $request, Result $data) {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $data = Result::onlyTrashed()->find($request->id);
            if ($data->restore()) {
                $request->session()->flash('message', $this->heading." has been restored successfully");
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', $this->heading." has not restored");
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
    public function forceDelete(Request $request, Result $data) {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $data = Result::find($request->id);
            if ($data->forceDelete()) {
                $request->session()->flash('message', $this->heading." has been forceDeleted successfully");
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', $this->heading." has not forceDeleted");
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
    
}
