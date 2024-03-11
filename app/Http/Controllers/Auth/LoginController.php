<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;


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
    // protected $redirectTo = '/user/dashboard';
    protected $redirectTo;


    public function login(Request $request)

    {
        // dd("31");
        if ($request->has('email')) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            // dd(113);
        }else {
            $request->validate([
                'account_no' => 'required',
                'password' => 'required',
            ]);
            // dd(112);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // dd(11,Auth::user());
            $this->redirectTo();
        } elseif (Auth::attempt(['user_name' => $request->email, 'password' => $request->password])) {
            // dd(12,Auth::user());
            $this->redirectTo();
        } elseif (Auth::attempt(['unique_id' => $request->account_no, 'password' => $request->password,'is_consultant' => 1])) {
            // dd(13,Auth::user());
            $this->redirectTo();
        } else {
            // dd(14,Auth::user());
            return redirect()->back()->withSuccess('Oppes! You have entered invalid credentials');
        }
        return redirect()->back()->withSuccess('Oppes! You have entered invalid credentials');

    }
    public function login_consultant()
    {
        return view('auth.consultant-login');

    }


    public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 1:
                $this->redirectTo = '/admin/dashboard';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo = '/user/dashboard';
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo = '/user/dashboard';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }

        // return $next($request);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
