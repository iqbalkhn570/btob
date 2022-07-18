<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Adminrole;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
	 public function __construct()
    {
        $this->heading="Role";
		$this->add_action="role_add";
		$this->edit_action="role_edit";
		$this->delete_action="admin_role_delete";
		$this->status_action="admin_role_changeStatus";
		$this->search_action="role";
		$this->folder="roles";
        $this->search="No";
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $query = Adminrole::Sortable()->Select('*');
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
		$parent_menu = Menu::where('status', 'enabled')
		//->where('parent_id', 0)
               ->orderBy('title')
               ->get();


		//$query = Menu::Select('*');
        //$query1 = $query->Where('parent_id','=', 0);
		//$query = $query1->Where('status','=','enable');
        //$parent_menu = $query->orderBy('title', 'DESC')->paginate(0);
        //$permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        

        $data = new Adminrole;
        return view('admin.'.$this->folder.'.add')->with(array('data'=>$data,'heading'=>$this->heading,'parent_menu'=>$parent_menu,'rolePermissions'=>$rolePermissions));
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
                'name' => 'required|max:255|unique:roles,name',
            ]);

            if (!$validatedData->fails())
            {
                //print_r(implode(',', $request->permission_menu));die;
				//$permission_menu=implode(',', $request->permission_menu);
                                if(!empty($request->permission_menu)){
                    $permission_menu=implode(',', $request->permission_menu);
   
                }else{
                     $permission_menu=0;
   
                }
                $role = Role::create(['name' => $request->input('name')]);
                $role->syncPermissions($request->input('permission'));

                $last=DB::table('roles')->latest('id')->first();
                $data =  Adminrole::find($last->id);
                //$data = new Adminrole;
                //$data->name = $request->name;
                //$data->guard_name = "web";
                $data->permission_menu = $permission_menu;
                $data->level =  $last->id;
				
                if($data->save()){
                   // $data->syncPermissions($request->input('permission'));
                    $request->session()->flash('message', $this->heading.' Added successfully');
                    $request->session()->flash('alert-class', 'alert-success');
					//return redirect({{ route(Role) }});
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
    public function edit(Request $request, Role $data)
    {
        $parent_menu = Menu::where('status', 'enabled')
		//->where('parent_id', 0)
               ->orderBy('title')
               ->get();


		//$query = Menu::Select('*');
       // $query = $query->Where('parent_id','=', 0);
       // $parent_menu = $query->orderBy('title', 'ASC')->paginate(0);
        
        $data = new Adminrole;
        $data = $data->findOrFail($request->id);

        $role = Role::find($request->id);
       // $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$request->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.'.$this->folder.'.add')->with(array('data'=>$data,'heading'=>$this->heading,'parent_menu'=>$parent_menu,'rolePermissions'=>$rolePermissions,'role'=>$role));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adminrole $data)
    {
        if($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(),[
                'name' => 'required|max:255|unique:roles,name,' . $request->id,


            ]);

            if (!$validatedData->fails() )
            { 
                if(!empty($request->permission_menu)){
                    $permission_menu=implode(',', $request->permission_menu);
   
                }else{
                     $permission_menu=0;
   
                }

                $data =  Adminrole::find($request->id);
               // $data->name = $request->name;
                $data->permission_menu = $permission_menu;
                $role = Role::find($request->id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
				
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
    public function destroy(Request $request, Adminrole $data)
    {
        $result = array('status'=>0, 'message'=>"");
        if($request->isMethod('get')) {
            $data =  Adminrole::find($request->id);
           if($data->delete()){
               
               \DB::transaction(function () use ($request) {
        \DB::table('users')->where('role_id', $request->id)->delete();
    });

               
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
            $data =  Adminrole::find($request->id);
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
