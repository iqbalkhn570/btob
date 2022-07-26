<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;
use Location;

class GeoLocationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->heading = "User";
        $this->add_action = "user_add";
        $this->edit_action = "user_edit";
        $this->delete_action = "admin_user_delete";
        $this->status_action = "admin_user_changeStatus";
        $this->search_action = "user";
        $this->folder = "user";
        $this->search = "No";
    }

    public function index(Request $request)
    {
            $ip = $request->ip();
            $data = \Location::get('8.8.8.8');
            echo "<pre>";
            print_r($data);
            //dd($data);
           // dd($ip);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $role = Role::Select('*');
        $data = $role->Where('id', '!=', 1);
        $data = $role->Where('status', '=', 'enabled');
        $data = $role->orderBy('id', 'DESC')->paginate(0);
        $user = new user;
        $action = array('Add');
        return view('admin.user.add')->with(array('user' => $user, 'role' => $data, 'action' => $action));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        if ($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(), [
                        'role' => 'required',
                        'name' => 'required',
                        //'email' => 'required',
                        'email' => 'required|email|unique:users,email',
                        //'password' => 'required'
                        'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*)(?=.*\d).+$/'
                            // 'image' => 'required_without_all:banner_content|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if (!$validatedData->fails()) {
                $image_name = '';
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('admin/images/user');
                    $image->move($destinationPath, $image_name);
                }

                $user = new User;
                $user->image = $image_name;
                $user->name = $request->name;
                $user->role_id = $request->role;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);

                if ($user->save()) {

                    $request->session()->flash('message', 'User Added successfully');
                    $request->session()->flash('alert-class', 'alert-success');
                    return redirect(route('user'));
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
    public function show(banners $banners) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, user $user) {
        $role = Role::Select('*');
        $data = $role->orderBy('id', 'DESC')->paginate(0);

        $user = new user;
        $user = $user->findOrFail($request->user_id);
        return view('admin.user.add')->with(array('user' => $user, 'role' => $data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user) {
        if ($request->isMethod('post')) {
            if($request->password != ""){
                $validatedData = Validator::make($request->all(), [
                        'role' => 'required',
                        'name' => 'required',
                        //'email' => 'required',
                        //'email' => 'required|email|unique:users,email',
                        'email' => 'required|email|unique:users,email,' . $request->user_id,
                        'password' => 'min:8|regex:/^(?=.*[a-z])(?=.*)(?=.*\d).+$/'


                            //'password' => 'required'
            ]);

            }else{
               $validatedData = Validator::make($request->all(), [
                        'role' => 'required',
                        'name' => 'required',
                        //'email' => 'required',
                        //'email' => 'required|email|unique:users,email',
                        'email' => 'required|email|unique:users,email,' . $request->user_id
                       // 'password' => 'min:8|regex:/^(?=.*[a-z])(?=.*)(?=.*\d).+$/'


                            //'password' => 'required'
            ]);
 
            }
            
            if (!$validatedData->fails()) {
                $user = user::find($request->user_id);
                $user->name = $request->name;
                $user->role_id = $request->role;
                $user->email = $request->email;
                if ($request->password != "") {
                    $user->password = Hash::make($request->password);
                }


                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('admin/images/user');
                    $image->move($destinationPath, $image_name);
                    $user->image = $image_name;
                }


                if ($user->save()) {

                    $request->session()->flash('message', 'User updated successfully');
                    $request->session()->flash('alert-class', 'alert-success');
                }
            }
            return redirect()
            ->back()
            ->withInput($request->all())
            ->withErrors($validatedData);
           // return redirect(route('user_edit', ['user_id' => $request->user_id]));
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
    public function destroy(Request $request, User $user) {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $user = user::find($request->id);
            if ($user->delete()) {
                $request->session()->flash('message', 'User has been deleted successfully');
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', 'User has not deleted');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    /**
     * Change resource status.
     *
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    // public function changeStatus(Request $request){
    //     $result = array('status'=>0, 'message'=>"");
    //     if($request->isMethod('post')) {
    //         $status = ($request->status == 'enabled'? 'disabled': 'enabled');
    //         $banners =  Banners::find($request->id);
    //         $banners->status = $status;
    //        if($banners->save()){
    //         $result = array('status'=>1, 'message'=>"Banner has been ".$status, 'bannerStatus' => $status);
    //        }
    //     }
    //     return response()->json($result);
    // }

    public function changeStatus(Request $request) {
        $result = array('status' => 0, 'message' => "");

        $status = ($request->status == 'enabled' ? 'disabled' : 'enabled');
        $User = User::find($request->id);
        $User->status = $status;
        if ($User->save()) {
            $request->session()->flash('message', "User has been " . $status);
            $request->session()->flash('alert-class', 'alert-success');
            return redirect()->back();
        }

        $request->session()->flash('message', 'User status has not');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

}
