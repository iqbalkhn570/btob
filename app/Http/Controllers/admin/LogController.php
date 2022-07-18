<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class LogController extends Controller {

    public function __construct() {
        $this->heading = "Log";
        $this->add_action = "log_add";
        $this->edit_action = "log_edit";
        $this->delete_action = "admin_log_delete";
        $this->status_action = "admin_log_changeStatus";
        $this->search_action = "log";
        $this->folder = "log";
        $this->search = "No";
        $this->middleware('permission:log-list|log-create|log-edit|log-delete', ['only' => ['index','show']]);
        $this->middleware('permission:log-create', ['only' => ['create','store']]);
        $this->middleware('permission:log-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:log-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $query = Log::Sortable()->Select('*');
        if ($request->search_term) {

            $query = $query->Where('ip', 'LIKE', "%{$request->search_term}%");
            $this->search = "Yes";
        }
        //if( $request->search_term1) {
            
           // $query = $query->Where('Users.name','LIKE', "%{$request->search_term1}%");
           // $this->search="Yes";
        //}
        if( $request->search_term1) {
            $search = $request->search_term1;
           
           $this->search="Yes";
            $query->WhereHas('users', function ($query) use ($search) {
               $query->where('name', 'like', '%'.$search.'%');
           });
       }
        $data = $query->orderBy('countryName', 'ASC')->paginate(DEFAULT_PAGINATION_LIMIT);
        return view('admin.' . $this->folder . '.list')->with(array('data' => $data, 'search' => $this->search, 'heading' => $this->heading, 'add_action' => $this->add_action, 'edit_action' => $this->edit_action, 'delete_action' => $this->delete_action, 'status_action' => $this->status_action, 'search_action' => $this->search_action));
    }

   
   
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Log $data) {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $data = Log::find($request->id);
            if ($data->delete()) {
                $request->session()->flash('message', $this->heading . ' has been deleted successfully');
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', $this->heading . ' has not deleted');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    

}
