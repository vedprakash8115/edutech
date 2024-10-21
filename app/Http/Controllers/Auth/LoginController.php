<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\PusherNotifier;
class LoginController extends Controller
{
    protected $pusherNotifier;

    public function __construct(PusherNotifier $pusherNotifier)
    {
        $this->pusherNotifier = $pusherNotifier;
    }
    
    public function insindex(){
       
        return view('auth.login');


    }
    // public function login(Request $request){
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    //     if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
    //         Alert::alert('Great', 'You have successfully Login!');
    //         $curr_user = Auth::user();
            
    //         $user_role = $curr_user->roles()->first();
    //         // dd($user_role);
    //          // Check if user has admin role and redirect accordingly
    //          if ($curr_user->hasAnyRole(['admin', 'agent','teacher'])) {
    //             return redirect()->route('insdashboard');
    //         } elseif ($curr_user->hasRole('student')) {
    //             return redirect()->route('student.home');
    //         } else {
    //             Auth::logout(); // Logout if role doesn't match expected roles
    //             Alert::alert('Error', 'You do not have the correct role.');
    //             return redirect()->route('inslogin');
    //         }

    //     }
    //     Alert::alert('Error', 'Email or Password is incurrect!');
    //     return redirect("login");
    // }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Alert::alert('Great', 'You have successfully logged in!');
            $curr_user = Auth::user();
            $user_role = $curr_user->roles()->first();
    
            // If request is from mobile, return JSON response
            if ($request->has('mobile')) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login successful',
                    'user' => $curr_user,
                ], 200);
            }
            // $message = "User Logged in successfully";

            // // Broadcast the success message
            // $this->pusherNotifier->sendMessage('my-channel', 'NotificationSent', $message);
            // Check if user has admin, agent, or teacher role and redirect accordingly
            if ($curr_user->hasAnyRole(['admin', 'agent', 'teacher'])) {
                return redirect()->route('insdashboard');
            } elseif ($curr_user->hasRole('student')) {
                return redirect()->route('student.home');
            } else {
                Auth::logout(); // Logout if role doesn't match expected roles
                Alert::alert('Error', 'You do not have the correct role.');
                return redirect()->route('inslogin');
            }
        }
    
        Alert::alert('Error', 'Email or Password is incorrect!');
        
        // If request is from mobile, return JSON error response
        if ($request->has('mobile')) {
            return response()->json([
                'status' => 401,
                'message' => 'Email or Password is incorrect!',
            ], 401);
        }
        
        return redirect("login");
    }
    
    public function logout(){
        Auth::logout();
        Alert::alert('Great', 'You have successfully logout!');
        return redirect()->route('inslogin');
    }
}
