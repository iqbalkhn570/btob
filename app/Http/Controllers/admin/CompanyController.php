<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class CompanyController extends Controller
{
	 public function __construct()
    {
        $this->heading="Business";
		$this->add_action="company_add";
		$this->edit_action="company_edit";
		$this->delete_action="admin_company_delete";
		$this->status_action="admin_company_changeStatus";
		$this->search_action="company";
		$this->folder="companys";
        $this->search="No";
        $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
        $this->middleware('permission:company-create', ['only' => ['create','store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query = Company::Sortable()->Select('*');
        if( $request->search_term && ($request->search_term!="%" && $request->search_term!="_" && $request->search_term!="_%" && $request->search_term!="%_")) {
            //echo $search=preg_replace('/%_*/', '', $request->search_term);
            $search=str_replace('%', '', $request->search_term);
            $search=str_replace('_', '', $search);
            $query = $query->Where('name','LIKE', "%{$search}%");
            $this->search="Yes";
        }
        $data1 = new Company;
		//$query = $query->Where('status','enabled');
        $data = $query->orderBy('id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);
        return view('admin.'.$this->folder.'.list')->with(array('data1'=>$data1,'data'=>$data,'search'=>$this->search,'heading'=>$this->heading,'add_action'=>$this->add_action,'edit_action'=>$this->edit_action,'delete_action'=>$this->delete_action,'status_action'=>$this->status_action,'search_action'=>$this->search_action));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Company;
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
               //'name' => 'required|max:255|alpha_num|unique:companies,name',
              // 'email' => 'required|regex:/(.+)@(.+)\.(.+)/i'
              // 'name' => ['required', 'max:255','alpha',"regex:/^([^\!'\*\\]*)$/"],
              'name1' => ['required','unique:companies,name','max:200','regex:/^[^(\|\]~`!%^&*=_};:?><???)]*$/'],

                //'name' => 'required|regex:[a-zA-Z0-9.,'"]+$/u|min:3|max:30',
                //'name' => 'required|regex:/^[\pL\s]+$/u|min:3|max:30',
            ],
            [
                'name1.regex' => 'The Bussiness title format is invalid',
                'name1.required' => 'The Name field is required.',
            ]);

            if (!$validatedData->fails())
            {
                $data = new company;
                $data->name = $request->name1;
                $data->slug = Str::slug($request->name1,'-');
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
    public function edit(Request $request, company $data)
    {
        $data = new company;
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
    public function update(Request $request, company $data)
    {
        // echo $request->id; die;
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'name' => ['required','max:200','regex:/^[^(\|\]~`!%^&*=_};:?><???)]*$/','unique:companies,name,' . $request->id],
            ],
            [
                'name.regex' => 'The Bussiness title format is invalid',
            ]);

            if (!$validatedData->fails() )
            { 
                $data =  company::find($request->id);
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
    public function destroy(Request $request, company $data)
    {
        $result = array('status'=>0, 'message'=>"");
        if($request->isMethod('get')) {
            $data =  Company::find($request->id);
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
        $data =  company::find($request->id);
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
