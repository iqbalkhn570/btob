<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class ProductController extends Controller
{
	 public function __construct()
    {
        $this->heading="Product";
		$this->add_action="product_add";
		$this->edit_action="product_edit";
		$this->delete_action="admin_product_delete";
		$this->status_action="admin_product_changeStatus";
		$this->search_action="product";
		$this->folder="products";
        $this->search="No";
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query = Product::Sortable()->Select('*');
        if( $request->search_term) {
            $query = $query->Where('name','LIKE', "%{$request->search_term}%");
            $this->search="Yes";
        }
		//$query = $query->Where('status','enabled');
        $data = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
        return view('admin.'.$this->folder.'.list')->with(array('data'=>$data,'search'=>$this->search,'heading'=>$this->heading,'add_action'=>$this->add_action,'edit_action'=>$this->edit_action,'delete_action'=>$this->delete_action,'status_action'=>$this->status_action,'search_action'=>$this->search_action));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Product;
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
                'name' => 'required|max:255|unique:products,name',
            ]);

            if (!$validatedData->fails())
            {
                $data = new product;
                $data->name = $request->name;
                $data->slug = Str::slug($request->name,'-');
                $data->first_prize_unit = $request->first_prize_unit;
                $data->first_prize_amnt = $request->first_prize_amnt;
                $data->second_prize_unit = $request->second_prize_unit;
                $data->second_prize_amnt = $request->second_prize_amnt;
                $data->third_prize_unit = $request->third_prize_unit;
                $data->third_prize_amnt = $request->third_prize_amnt;
                $data->special_prize_unit = $request->special_prize_unit;
                $data->special_prize_amnt = $request->special_prize_amnt;
                $data->consolation_prize_unit = $request->consolation_prize_unit;
                $data->consolation_prize_amnt = $request->consolation_prize_amnt;
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
    public function edit(Request $request, product $data)
    {
        $data = new product;
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
    public function update(Request $request, product $data)
    {
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'name' => 'required|max:255|unique:products,name,' . $request->id,
            ]);

            if (!$validatedData->fails() )
            { 
                $data =  product::find($request->id);
                $data->name = $request->name;
                $data->slug = Str::slug($request->name,'-');
                $data->first_prize_unit = $request->first_prize_unit;
                $data->first_prize_amnt = $request->first_prize_amnt;
                $data->second_prize_unit = $request->second_prize_unit;
                $data->second_prize_amnt = $request->second_prize_amnt;
                $data->third_prize_unit = $request->third_prize_unit;
                $data->third_prize_amnt = $request->third_prize_amnt;
                $data->special_prize_unit = $request->special_prize_unit;
                $data->special_prize_amnt = $request->special_prize_amnt;
                $data->consolation_prize_unit = $request->consolation_prize_unit;
                $data->consolation_prize_amnt = $request->consolation_prize_amnt;
				
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
    public function destroy(Request $request, product $data)
    {
        $result = array('status'=>0, 'message'=>"");
        if($request->isMethod('get')) {
            $data =  Product::find($request->id);
           if($data->delete()){
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
        $data =  product::find($request->id);
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
}
