<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    public function insindex(){
        return view('auth.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
   
    //$credentialsdata = $request->only('email', 'password');
   // print_r($credentialsdata); die;
        $credentialsdata = [
            'email' => $request->email,
            'password' => $request->password
        ];
    if (Auth::attempt($credentialsdata)) {
            $request->session()->regenerate();
            Alert::toast('Welcome to the dashboard!', 'success');
            return redirect()->intended('ins/dashboard');
    }
    // dd('Authentication failed', $credentialsdata, Auth::attempt($credentialsdata));
        Alert::toast('Problem in login!', 'warning');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){
         Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('ins/login');
    }

}
