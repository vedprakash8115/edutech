<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\PusherNotifier;
use App\Models\User;
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
        return redirect()->route('login');
    }
    public function forgot()
    {
        
        session(['step1' => true]);
        return view('auth.forgot');
    }
    public function send_otp(Request $request)
    {
        // Validate the request to ensure the email is present
        $request->validate([
            'email' => 'required|email',
        ]);
        session()->forget('step1');


        // Check if the user exists with the provided email
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // User exists, generate the OTP
            $otp = random_int(100000, 999999);
            
            // You can store the OTP in session, database, or send it via email
            session(['otp' => $otp]);
            session(['step2' => true]);
    
            $details = [
                'title' => "Here is your 6 digit OTP to reset your password",
                'body' => "The OTP is: " . $otp,
            ];
        
            // Send OTP via email
            Mail::to($user->email)->send(new TestMail($details));
            // You may send the OTP to the user's email here (if needed)
    
            // return response()->json([
            //     'status' => true,
            //     'message' => 'OTP generated successfully.',
            //     'otp' => $otp // For testing purposes, you might want to remove this later
            // ]);
            return redirect()->route('enter_otp')->with([
                'success' => true,
                'message' => 'Please enter your OTP.',
            ]);
            
        } else {
            // User not found, stop execution with a message
            return redirect()->route('enter_otp')->with([
                'success' => false,
                'message' => 'Wrong Credentials.',
            ]);
        }
       
    }
    
}
