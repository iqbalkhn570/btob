<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 60; // Default is 1

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            // new rules here
        ],
        [
            
            'email.required' => 'The UserID field is required',
        ]);
    }
    protected function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('admin/login');
    }
    public function googleRegistration(Request $request)
    {
        
        if (session('2fa:user:id')) {
            $google2fa = app('pragmarx.google2fa');

        $registration_data = $request->all();

        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
        $registration_data["login_user_id"] = session('2fa:user:id');
        $registration_data["login_user_email"] = session('2fa:user:emailid');

        $request->session()->flash('registration_data', $registration_data);

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['login_user_email'],
           //'jerry.tam@kk-lotto.com',
            $registration_data['google2fa_secret']
        );

        return view('admin.google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);
        }

        return redirect('admin/login');
        

    }
    public function completeRegistration(Request $request)
    {        
        //$request->merge(session('registration_data'));
       // print_r(Auth::user()->id);
       $google2fa_secret=session::get('registration_data')['google2fa_secret'];
       $login_user_id=session::get('registration_data')['login_user_id'];
       DB::table('users')->where('id',$login_user_id)->update(array('google2fa_secret' => $google2fa_secret));
       //print_r(session('registration_data[0]'));
      // dd(Session::get('registration_data'));
       //echo  session::get('registration_data')['google2fa_secret'];
      // echo $request->session()->get($registration_data["google2fa_secret"]);
      //print_r(Session::get('registration_data[google2fa_secret]'));die;
        //print_r(session("registration_data['google2fa_secret']"));die;

        return redirect('admin/login');
    }
}
