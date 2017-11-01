<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function cekLogin(Request $req){
        $email = $req->input('username');
        $password = $req->input('password');
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            return redirect('/');
        }else{
            $req->session()->flash('message', 'Warning');
            $req->session()->flash('flash_message', 'email or password wrong!');
            $req->session()->flash('type', 'warning');
            $req->session()->flash('confirm_button', 'btn-success');
            return redirect('login');
        }
    }
}
