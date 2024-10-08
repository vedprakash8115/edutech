<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    
    public function insindex(){
        return view('auth.login');

    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            Alert::alert('Great', 'You have successfully Login!');
            $curr_user = Auth::user();
            
            $user_role = $curr_user->roles()->first();
            // dd($user_role);
             // Check if user has admin role and redirect accordingly
             if ($curr_user->hasAnyRole(['admin', 'agent'])) {
                return redirect()->route('insdashboard');
            } elseif ($curr_user->hasRole('student')) {
                return redirect()->route('student.profile');
            } else {
                Auth::logout(); // Logout if role doesn't match expected roles
                Alert::alert('Error', 'You do not have the correct role.');
                return redirect()->route('inslogin');
            }

        }
        Alert::alert('Error', 'Email or Password is incurrect!');
        return redirect("login");
    }
    public function logout(){
        Auth::logout();
        Alert::alert('Great', 'You have successfully logout!');
        return redirect()->route('inslogin');
    }
}
