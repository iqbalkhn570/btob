<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Adminrole;
use App\Models\Country;
use App\Models\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->heading = "User";
        $this->add_action = "user_add";
        $this->edit_action = "user_edit";
        $this->delete_action = "admin_user_delete";
        $this->status_action = "admin_user_changeStatus";
        $this->search_action = "user";
        $this->folder = "user";
        $this->search = "No";
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //$data1 = session()->all();
//print_r(Auth::id());
        $user = User::Sortable()->Select('*');
        if ($request->search_term) {
            if (Auth::user()->role_id == 1) {
                $user = $user->withTrashed()->Where('name', 'LIKE', "%{$request->search_term}%")->orWhere('email', 'LIKE', "%{$request->search_term}%");
                $this->search = "Yes";

            } else {
                $user = $user->Where('name', 'LIKE', "%{$request->search_term}%")->orWhere('email', 'LIKE', "%{$request->search_term}%");
                $this->search = "Yes";
            }

        }
        if (!empty($request->role_id)) {
            $user = $user->Where('users.role_id', $request->role_id);
        }
        if (!empty($request->created_by)) {
            $user = $user->Where('created_by', $request->created_by);
        }
        $user = $user->whereNotIn('users.role_id', [1, 2]);
        $user = $user->Where('users.id', '!=', Auth::user()->id);
        if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {

        } else {
            $user = $user->Where('created_by', '=', Auth::user()->id);
        }

        $data = $user->orderBy('users.id', 'DESC')->paginate(DEFAULT_PAGINATION_LIMIT);

        $role = Adminrole::Select('*');
        $roles = $role->whereNotIn('id', [1, 2]);
        $roles = $role->Where('status', '=', 'enabled');
        $roles = $role->Where('level', '>', Auth::user()->role_id);
        $roles = $role->orderBy('name', 'ASC')->paginate(0);
        return view('admin.user.list')->with(array('user' => $data, 'search' => $this->search, 'roles' => $roles));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Adminrole::Select('*');
        $data = $role->whereNotIn('id', [1, 2]);
        $data = $role->Where('status', '=', 'enabled');
        $data = $role->Where('level', '>', Auth::user()->role_id);
        $data = $role->orderBy('name', 'ASC')->paginate(0);
        $country = Country::Select('*');
        $countries = $country->orderBy('name', 'ASC')->paginate(300);

        $user = new user;
        $action = array('Add');
        return view('admin.user.add')->with(array('user' => $user, 'role' => $data, 'countries' => $countries, 'action' => $action));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->isMethod('post')) {
            $validatedData = Validator::make($request->all(), [
                'role' => 'required',
                'name' => 'required|regex:/^[\pL\s]+$/u|min:3|max:30',

                //'email' => 'required',
                'ip_address' => 'nullable|ip',
                'account_balance' => 'nullable|numeric',
                'contact_number' => 'nullable|numeric',
                'account_number' => 'nullable|numeric',
                'email' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
                'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*)(?=.*\d).+$/',
                // 'image' => 'required_without_all:banner_content|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
                [
                    'email.alpha_dash' => 'The User ID must only contain letters, numbers, dashes and underscores',
                    'email.unique' => 'The User ID already exists',
                ]);

            if (!$validatedData->fails()) {
                //$image_name = '';
                //if ($request->hasFile('image')) {
                //$image = $request->file('image');
                // $image_name = time() . '.' . $image->getClientOriginalExtension();
                // $destinationPath = public_path('admin/images/user');
                // $image->move($destinationPath, $image_name);
                //}

                $user = new User;
                //$user->image = $image_name;
                $user->name = $request->name;
                $user->role_id = $request->role;
                $user->email = $request->email;
                $user->contact_number = $request->contact_number;
                $user->ip_address = $request->ip_address;
                $user->nationality_id = $request->nationality_id;
                $user->current_country_id = $request->current_country_id;
                //$user->assign_agent = $request->assign_agent;
                // $user->assign_master_agent = $request->assign_master_agent;
                // $user->assign_senior_manager = $request->assign_senior_manager;
                $user->created_by = Auth::user()->id;
                $user->password = Hash::make($request->password);

                if ($user->save()) {
                    $user_id = $user->id;
                    $account = new Account;
                    $account->account_balance = $request->account_balance;
                    $account->payment_method = $request->payment_method;
                    $account->account_number = $request->account_number;
                    $account->user_id = $user_id;
                    $account->save();
                    $user->assignRole($request->role);
                    $request->session()->flash('message', 'User Added successfully');
                    $request->session()->flash('alert-class', 'alert-success');
                    //return redirect(route('user'));
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
    public function edit(Request $request, user $user)
    {

        $role = Adminrole::Select('*');
        $data = $role->whereNotIn('id', [1, 2]);
        $data = $role->Where('status', '=', 'enabled');
        $data = $role->Where('level', '>', Auth::user()->role_id);
        $data = $role->orderBy('id', 'DESC')->paginate(0);

        $user = User::join('accounts', 'accounts.user_id', '=', 'users.id')->Where('accounts.user_id', '=', $request->user_id)->first();

        //$user = new user;
        //$user = $user->findOrFail($request->user_id);
        $country = Country::Select('*');
        $countries = $country->orderBy('name', 'ASC')->paginate(300);
        return view('admin.user.add')->with(array('user' => $user, 'role' => $data, 'countries' => $countries));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        if ($request->isMethod('post')) {
            if ($request->password != "") {
                $validatedData = Validator::make($request->all(), [
                    'role' => 'required',
                    'name' => 'required|regex:/^[\pL\s]+$/u|min:3|max:30',
                    'account_balance' => 'nullable|numeric',
                    'contact_number' => 'nullable|numeric',
                    'ip_address' => 'nullable|ip',
                    'account_number' => 'nullable|numeric',
                    'email' => 'required|string|max:255|alpha_dash|unique:users,email,' . $request->user_id,
                    //'email' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
                    'password' => 'min:8|regex:/^(?=.*[a-z])(?=.*)(?=.*\d).+$/',

                    //'password' => 'required'
                ],
                    [
                        'email.alpha_dash' => 'The User ID must only contain letters, numbers, dashes and underscores',
                        'email.unique' => 'The User ID already exists',
                    ]);
            } else {
                $validatedData = Validator::make($request->all(), [
                    'role' => 'required',
                    'name' => 'required|regex:/^[\pL\s]+$/u|min:3',
                    'account_balance' => 'nullable|numeric',
                    'contact_number' => 'nullable|numeric',
                    'ip_address' => 'nullable|ip',
                    'account_number' => 'nullable|numeric',
                    'email' => 'required|string|max:255|alpha_dash|unique:users,email,' . $request->user_id,
                    // 'password' => 'min:8|regex:/^(?=.*[a-z])(?=.*)(?=.*\d).+$/'

                    //'password' => 'required'
                ],
                    [
                        'email.alpha_dash' => 'The User ID must only contain letters, numbers, dashes and underscores',
                    ]);

            }

            if (!$validatedData->fails()) {
                $user = user::find($request->user_id);
                $user->name = $request->name;
                $user->role_id = $request->role;
                $user->email = $request->email;
                $user->contact_number = $request->contact_number;
                $user->ip_address = $request->ip_address;
                $user->nationality_id = $request->nationality_id;
                $user->current_country_id = $request->current_country_id;
                //$user->assign_agent = $request->assign_agent;
                //$user->assign_master_agent = $request->assign_master_agent;
                // $user->assign_senior_manager = $request->assign_senior_manager;
                $user->updated_by = Auth::user()->id;
                if ($request->password != "") {
                    $user->password = Hash::make($request->password);
                }

                //if ($request->hasFile('image')) {
                // $image = $request->file('image');
                // $image_name = time() . '.' . $image->getClientOriginalExtension();
                // $destinationPath = public_path('admin/images/user');
                // $image->move($destinationPath, $image_name);
                // $user->image = $image_name;
                //}

                if ($user->save()) {
                    //$account = Account::firstOrFail($request->user_id);
                    //$account->account_balance = $request->account_balance;
                    //$account->payment_method = $request->payment_method;
                    //$account->account_number = $request->account_number;
                    //$account->updateOrCreate();

                    $account = Account::updateOrCreate(['user_id' => $request->user_id],
                        ['account_balance' => $request->account_balance, 'payment_method' => $request->payment_method, 'account_number' => $request->account_number, 'user_id' => $request->user_id]);

                    $user->assignRole($request->role);
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
    public function destroy(Request $request, User $user)
    {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $user = user::find($request->id);
            if ($user->delete()) {
                $user->deleted_by = Auth::user()->id;
                $user->save();
                $request->session()->flash('message', 'User has been deleted successfully');
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', 'User has not deleted');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
    public function reset(Request $request, User $user)
    {

        if ($request->isMethod('get')) {
            $user = user::find($request->id);
            $user->google2fa_secret = '';
            if ($user->save()) {
                $request->session()->flash('message', 'User has been reset successfully');
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', 'User has not reset');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
    public function restore(Request $request, User $user)
    {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $user = user::onlyTrashed()->find($request->id);
            if ($user->restore()) {
                $request->session()->flash('message', 'User has been restored successfully');
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', 'User has not restored');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
    public function forceDelete(Request $request, User $user)
    {
        $result = array('status' => 0, 'message' => "");
        if ($request->isMethod('get')) {
            $user = user::find($request->id);
            if ($user->forceDelete()) {
                $request->session()->flash('message', 'User has been forceDeleted successfully');
                $request->session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
        }
        $request->session()->flash('message', 'User has not forceDeleted');
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

    public function changeStatus(Request $request)
    {
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
    public function getSeniorManager()
    {
        $data['senior_manager'] = User::where("role_id", 3)
            ->get(["name", "id"]);
        return response()->json($data);
    }

    public function getMasterAgent(Request $request)
    {
        $data['master_agent'] = User::where([
            'role_id' => 4,
            'assign_senior_manager' => $request->assign_senior_manager,
        ])
            ->get(["name", "id"]);
        return response()->json($data);
    }
    public function getAgent(Request $request)
    {
        $data['agent'] = City::where([
            'role_id' => 5,
            'assign_master_agent' => $request->assign_master_agent,
        ])
            ->get(["name", "id"]);
        return response()->json($data);
    }
    /**
     * Show user online status.
     */
    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            } else {
                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            }

        }
    }

}
