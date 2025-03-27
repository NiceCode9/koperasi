<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $identifier = $request->username;
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'telephone';

        $credentials = [
            $field => $identifier,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }

        Alert::error('Login Gagal', 'Akun dan password salah');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
