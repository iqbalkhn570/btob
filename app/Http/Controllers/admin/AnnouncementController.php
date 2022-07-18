<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class AnnouncementController extends Controller
{
	 public function __construct()
    {
        $this->heading="Announcement";
		$this->add_action="announcement_add";
		$this->edit_action="announcement_edit";
		$this->delete_action="admin_announcement_delete";
		$this->status_action="admin_announcement_changeStatus";
		$this->search_action="announcement";
		$this->folder="announcements";
        $this->search="No";
        $this->middleware('permission:announcement-list|announcement-create|announcement-edit|announcement-delete', ['only' => ['index','show']]);
        $this->middleware('permission:announcement-create', ['only' => ['create','store']]);
        $this->middleware('permission:announcement-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:announcement-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query = Announcement::Sortable()->Select('*');
        if( $request->search_term) {
            
            $query = $query->Where('name','LIKE', "%{$request->search_term}%");
            $this->search="Yes";
        }
		//$query = $query->Where('status','enabled');
                $query = $query->Where('id','!=',1);

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
		
        $data = new Announcement;
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
                'name' => 'required|max:255|unique:announcements,name',
                'content' => 'required',
                'content_chinese' => 'required',
                'content_thai' => 'required',
                'content_khmer' => 'required',
                'content_viet' => 'required',
                'content_korean' => 'required',
            ]);

            if (!$validatedData->fails())
            {
                $data = new Announcement;
                $data->name = $request->name;
                $data->slug = Str::slug($request->name,'-');
                $data->content = $request->content;
                $data->content_chinese = $request->content_chinese;
                $data->content_thai = $request->content_thai;
                $data->content_khmer = $request->content_khmer;
                $data->content_viet = $request->content_viet;
                $data->content_korean = $request->content_korean;
				
                if($data->save()){
                    $request->session()->flash('message', $this->heading.' Added successfully');
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
    public function edit(Request $request, Announcement $data)
    {
        $data = new Announcement;
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
    public function update(Request $request, Announcement $data)
    {
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'name' => 'required|max:255|unique:announcements,name,' . $request->id,
                'content' => 'required',
                'content_chinese' => 'required',
                'content_thai' => 'required',
                'content_khmer' => 'required',
                'content_viet' => 'required',
                'content_korean' => 'required',
            ]);

            if (!$validatedData->fails() )
            { 
                $data =  Announcement::find($request->id);
                $data->name = $request->name;
                $data->slug = Str::slug($request->name,'-');
                $data->content = $request->content;
                $data->content_chinese = $request->content_chinese;
                $data->content_thai = $request->content_thai;
                $data->content_khmer = $request->content_khmer;
                $data->content_viet = $request->content_viet;
                $data->content_korean = $request->content_korean;
				
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
    public function destroy(Request $request, Announcement $data)
    {
        $result = array('status'=>0, 'message'=>"");
        if($request->isMethod('get')) {
            $data =  Announcement::find($request->id);
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
        $data =  Announcement::find($request->id);
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
