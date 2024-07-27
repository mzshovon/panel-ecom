<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AuthenticateWebUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CustomLoginController extends Controller
{
    use AuthenticateWebUser;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show User Login Form
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    // Handle User Login
    public function userLogin(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::guard('web')->attempt($this->credentials($request), $request->filled('remember'))) {
            return redirect()->intended('/'); // or any user dashboard route
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('home');
    }

    // Other methods like validateLogin, credentials, sendFailedLoginResponse, etc.
}
