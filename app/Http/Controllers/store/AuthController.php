<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:stores,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard(PermissionName::$store)->attempt(['email' => $req->email, 'password' => $req->password, 'remember_token' => $req->remember_me])) {
                return redirect()->route('store.cdashboard')->with('toast_success', 'Welcome ');
            
        } else {
            return redirect()->back()->with('toast_error', 'Invalid Credentials');
        }
    }

    //logout
    public function logout()
    {
        Auth::guard(PermissionName::$employee)->logout();
        return redirect()->route('auth.login-view')->with('toast_success', 'Logged Out');
    }
}
