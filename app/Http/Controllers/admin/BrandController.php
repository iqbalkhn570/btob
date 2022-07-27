<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use App\Exports\BrandsExport;
use App\Imports\BrandsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
	 public function __construct()
    {
        $this->heading="Game";
		$this->add_action="brand_add";
		$this->edit_action="brand_edit";
		$this->delete_action="admin_brand_delete";
		$this->status_action="admin_brand_changeStatus";
		$this->search_action="brand";
        $this->import_action="brand_import";
        $this->import_sample_action="brand_sample_file";
        $this->show_action="brand_show";
		$this->folder="brands";
        $this->search="No";
        $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index','show']]);
        $this->middleware('permission:brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query = Brand::Sortable()->Select('*');
        if( $request->search_term && ($request->search_term!="%" && $request->search_term!="_" && $request->search_term!="_%" && $request->search_term!="%_")) {
        if(Auth::user()->role_id==1 || Auth::user()->role_id==2){
            $query = $query->withTrashed()->Where('name', 'LIKE', "%{$request->search_term}%");
        $this->search = "Yes";

        }else{
            $query = $query->Where('name', 'LIKE', "%{$request->search_term}%");
            $this->search = "Yes";
        }
        }
        
        $data1 = new Brand;
		//$query = $query->Where('status','enabled');
        $data = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
        return view('admin.'.$this->folder.'.list')->with(array('data1'=>$data1,'data'=>$data,'search'=>$this->search,'heading'=>$this->heading,'add_action'=>$this->add_action,'edit_action'=>$this->edit_action,'show_action'=>$this->show_action,'delete_action'=>$this->delete_action,'status_action'=>$this->status_action,'search_action'=>$this->search_action));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Brand;
        return view('admin.'.$this->folder.'.add')->with(array('data'=>$data,'heading'=>$this->heading,'search_action'=>$this->search_action));
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
                //'name' => 'bail|required|unique:brands,name|max:255|min:1',
                'name1' => ['required','unique:brands,name','max:200','regex:/^[^(\|\]~`!%^&*=_};:?><’)]*$/'],
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ],
            [
                'name1.regex' => 'The Game title format is invalid',
                'name1.required' => 'The Game title field is required.',
                'name1.unique' => 'The Game title has already been taken.',
            ]);
            if (!$validatedData->fails())
            {
                $image_name = '';
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('frontend/images/brand');
                    $image->move($destinationPath, $image_name);
                }
                $data = new brand;
                $data->name = $request->name1;
                $data->image = $image_name;
                $data->slug = Str::slug($request->name1,'-');
                $data->created_by = Auth::user()->id;
                if($data->save()){
                    $request->session()->flash('message', $this->heading.' added successfully');
                    $request->session()->flash('alert-class', 'alert-success');
					return redirect(route($this->search_action));
                }
            }
            return redirect()->back()->withInput($request->all())->withErrors($validatedData); 
        }
        return redirect()->back()->withInput($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, brand $data)
    {
        $data = new brand;
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
    public function update(Request $request, brand $data)
    {
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'name' => ['required','max:200','regex:/^[^(\|\]~`!%^&*=_};:?><’)]*$/','unique:brands,name,' . $request->id],
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ],
            [
                'name.regex' => 'The Game title format is invalid',
                'name.unique' => 'The Game title has already been taken.',
            ]);

            if (!$validatedData->fails() )
            { 
                $data =  brand::find($request->id);
                $data->name = $request->name;
                $data->slug = Str::slug($request->name,'-');
                $data->updated_by = Auth::user()->id;
                if($request->hasFile('image'))
                {
                    $image = $request->file('image');
                    $image_name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('frontend/images/brand');
                    $image->move($destinationPath, $image_name);
                    $data->image = $image_name;
                 }
				
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
    public function destroy(Request $request, brand $data)
    {
        $result = array('status'=>0, 'message'=>"");
        if($request->isMethod('get')) {
            $data =  Brand::find($request->id);
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
        $data =  brand::find($request->id);
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
        return Excel::download(new BrandsExport, 'brands.xlsx');
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
        Excel::import(new BrandsImport,request()->file('select_file'));
               
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
            $file = $request->file('select_file')->store('import/brand');/* file will save in storage/import/bank folder */
            
            $import = new BrandsImport;
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
                            $brand =  Brand::where('name', $row['name']);
                            if($brand->count() == 1){
                            // $data_array['updated_at'] = Carbon::now();
                                /* Update Row */
                                $brand->update($data_array);
                                $updatedRows++;
                            }else{
                            // $data_array['created_at'] = Carbon::now();
                                /* Insert Row */
                                $brand->insert($data_array);
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
        $filename = 'brand-sample-excel.xlsx';
        $path = public_path('admin/samples/'.$filename);

        // Download file with custom headers
        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
    public function show(Request $request, Brand $data)
    {
        $data = new Brand;
        $data = $data->findOrFail($request->id);
        return view('admin.'.$this->folder.'.show')->with(array('data'=>$data,'heading'=>$this->heading,'search_action'=>$this->search_action));
    }
    public function restore(Request $request, Brand $data) {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $data = Brand::onlyTrashed()->find($request->id);
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
    public function forceDelete(Request $request, Brand $data) {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $data = Brand::find($request->id);
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
