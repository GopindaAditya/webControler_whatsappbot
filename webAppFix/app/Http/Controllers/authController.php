<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class authController extends Controller
{
    function index() {
        return view("login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            Alert::success('Login Success');
            return redirect()->route('dateList');        
        } else {
            // Autentikasi gagal
            Alert::error('Login Failed', 'Email or password is incorrect');
            return redirect()->back()->withErrors(['email' => 'Email atau kata sandi salah']);
        }
    }

    public function logout()
    {
        Auth::logout();        
        Alert::success('Logout Success');
        return redirect()->route('login');          
    }

}
