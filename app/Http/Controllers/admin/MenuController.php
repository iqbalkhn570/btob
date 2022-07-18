<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Nav_icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class MenuController extends Controller
{
	 public function __construct()
    {
        $this->heading="Menu";
		$this->add_action="menu_add";
		$this->edit_action="menu_edit";
		$this->delete_action="admin_menu_delete";
		$this->status_action="admin_menu_changeStatus";
		$this->search_action="menu";
		$this->folder="menus";
        $this->search="No";
        $this->middleware('permission:menu-list|menu-create|menu-edit|menu-delete', ['only' => ['index','show']]);
        $this->middleware('permission:menu-create', ['only' => ['create','store']]);
        $this->middleware('permission:menu-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:menu-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query = Menu::Sortable()->Select('*');
        if( $request->search_term) {
            
            $query = $query->Where('title','LIKE', "%{$request->search_term}%");
            $this->search="Yes";
        }
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
		$query = Menu::Select('*');
        $query = $query->Where('parent_id','=', 0);
        $parent_menu = $query->orderBy('title', 'DESC')->get();
        //echo "<pre>";
        //print_r($parent_menu);
        $query1 = Nav_icon::Select('*');
		$nav_icon = $query1->orderBy('title', 'DESC')->paginate(0);


        $data = new Menu;
        return view('admin.'.$this->folder.'.add')->with(array('data'=>$data,'heading'=>$this->heading,'parent_menu'=>$parent_menu,'nav_icon'=>$nav_icon));
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
                'title' => 'required|max:255|unique:menus,title',
                'position' => 'numeric',
            ]);

            if (!$validatedData->fails())
            {
                
                $data = new Menu;
                $data->title = $request->title;
                $data->position = $request->position;
				$data->url = $request->url;
												$data->slug = $request->url;
																				$data->nav_icon = $request->nav_icon;


				$data->parent_id = $request->parent_id;
                if($data->save()){
                    
                    $request->session()->flash('message', $this->heading.' Added successfully');
                    $request->session()->flash('alert-class', 'alert-success');
					//return redirect({{ route(menu) }});
					//return redirect()->back();
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
     * Display the specified resource.
     *
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function show(banners $banners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Menu $data)
    {
		$query = Menu::Select('*');
        $query = $query->Where('parent_id','=', 0);
        $parent_menu = $query->orderBy('title', 'DESC')->paginate(0);
$query1 = Nav_icon::Select('*');
		$nav_icon = $query1->orderBy('title', 'DESC')->paginate(0);

        $data = new Menu;
        $data = $data->findOrFail($request->id);
        return view('admin.'.$this->folder.'.add')->with(array('data'=>$data,'heading'=>$this->heading,'parent_menu'=>$parent_menu,'nav_icon'=>$nav_icon));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $data)
    {
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'title' => 'required|max:255',

                'position' => 'numeric'

            ]);

            if (!$validatedData->fails() )
            {   
                $data =  Menu::find($request->id);
                $data->title = $request->title;
                $data->position = $request->position;
				$data->url = $request->url;
								$data->slug = $request->url;
								$data->nav_icon = $request->nav_icon;

				$data->parent_id = $request->parent_id;
                
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
    public function destroy(Request $request, Menu $data)
    {
        $result = array('status'=>0, 'message'=>"");
        if($request->isMethod('get')) {
            $data =  Menu::find($request->id);
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
            $data =  Menu::find($request->id);
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
