<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        //If the status is not approved redirect to login 
        if(Auth::check() && Auth::user()->status != 'enabled'){
            Auth::logout();
            $request->session()->flash('message', 'Your account is disabled');
            $request->session()->flash('alert-class', 'alert-danger');
            return redirect('admin/login')->with('erro_login', 'Your no active user');
        }
        //if(!empty(Auth::user()->google2fa_secret == '')){
        //if(Auth::user()->google2fa_secret == ''){
           // $request->session()->put('2fa:user:id', Auth::user()->id);
           // $request->session()->put('2fa:user:emailid', Auth::user()->email);
           // Auth::logout();
           // return redirect('admin/google-registration');
        //}
   // }
        return $response;
    }
}