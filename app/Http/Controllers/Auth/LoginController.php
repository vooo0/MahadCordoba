<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            if(Auth::user()->level == 'umum'){
                return redirect(route('admin.dashboard'));
            }else
            if(Auth::user()->level == 'keuangan'){
                return redirect()->route('keuangan.dashboard');
            }else
            if(Auth::user()->level == 'guru'){
                return redirect()->route('guru.dashboard');
            }else
            if(Auth::user()->level == 'siswa'){
                return redirect()->route('siswa.dashboard');
            }else{
                return view('user.auth.login');
            }
        }
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];
 
        Auth::attempt($data);
 
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            if(Auth::user()->level == 'umum'){
                return redirect(route('admin.dashboard'));
            }else
            if(Auth::user()->level == 'keuangan'){
                return redirect()->route('keuangan.dashboard');
            }else
            if(Auth::user()->level == 'guru'){
                return redirect()->route('guru.dashboard');
            }else
            if(Auth::user()->level == 'siswa'){
                return redirect()->route('siswa.dashboard');
            }else{
                return view('user.auth.login');
            }
 
        } else { // false
 
            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
 
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
