<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    function __construct()
    {
        $this->middleware('guest')->only(['login', 'register', 'loginProccess', 'registrationProccess']);
        $this->middleware('auth')->only(['logout']);
    }
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProccess(Request $request)
    {
        $endcriptPassword = Hash::make($request->password);

        $request->merge([
            'password' => $endcriptPassword,
        ]);

        User::create($request->all());

        return redirect('/login');
    }

    public function loginProccess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $isLoginSuccess = Auth::attempt($credentials);

        if ($isLoginSuccess) {
            return redirect()->intended('/admin/home');
        } else {
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
