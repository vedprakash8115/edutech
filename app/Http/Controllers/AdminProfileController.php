<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;   
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use League\Csv\Reader;
use App\Mail\TestMail;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;

class AdminProfileController extends Controller
{
    public function show()
    {
        $admin = request()->user(); // Fetch authenticated admin
        return view('ins.content.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email',
            'current_password' => 'nullable',
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        $user = auth()->user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        $user = auth()->user();
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
        
    
            return redirect()->back()->with([
                'success' => true,
                'message' => 'Profile updated successfully!',
                 // This will pass the session data as an array
            ]);
            
        
    }
    public function verifyOtp(Request $request)
    {
            $otp = $request->otp;
    
        // // Check if OTP matches and has not expired
      
        //     // Get user data from session
        //     $user = auth()->user();
        //     $user->name = session('name');
        //     $user->mobile = session('mobile');
        //     $user->password = Hash::make(session('new_password'));
        //     $user->save();
    
        // //     // Clear OTP data from session
        //     session()->forget(['password_change_otp', 'password_change_otp_expiry', 'new_password', 'name', 'mobile']);
    
            return response()->json(['success' => true , 'otp' => $otp , session()->all()]);
        
    
        // return response()->json(['status' => 'error']);
    }
        
    public function requestPasswordChange(Request $request)
    {
        $request->validate([
           
        ]);

        $user = auth()->user();

        // Verify current password
       

        // Generate OTP
       

        // Send OTP email
  

        return back()->with('success', 'OTP has been sent to your email address');
    }
    public function verifyPasswordChange(Request $request)
    {
        $request->validate([
            'otp' => 'required|string'
        ]);

        // Check if OTP exists and is valid
        if (!session('password_change_otp') || 
            !session('password_change_otp_expiry') || 
            !session('new_password') ||
            now()->isAfter(session('password_change_otp_expiry'))) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        // Verify OTP
        if ($request->otp !== session('password_change_otp')) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        // Update password
        $user = auth()->user();
        $user->password = Hash::make(session('new_password'));
        $user->save();

        // Clear session data
        session()->forget(['password_change_otp', 'password_change_otp_expiry', 'new_password']);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function addUser(Request $request)
    {
        Log::info($request);
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_mobile' => 'required|string|max:20',
            'user_city' => 'required|string|max:100',
            'user_state' => 'required|string|max:100',
            'user_country' => 'required|string|max:100',
        ]);

          // Extract email prefix (part before @)
          if(!request() -> has('user_password') || empty($request->password)){
            $emailPrefix = explode('@', $request->user_email)[0];

            // Create password based on email prefix
            $password = $emailPrefix . '@123';
          }
          else{
            $password = $request->user_password;
          }

        // Create the new user
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'mobile' => $request->user_mobile,
            'city' => $request->user_city,
            'state' => $request->user_state,
            'country' => $request->user_country,
            'password' => Hash::make($password),
        ]);
     
        return redirect()->back()->with('success', 'User added successfully');
    }

    public function bulkAddUsers(Request $request)
    {
        // Validate that a file was uploaded and is a CSV
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        // Read the CSV file
        $file = $request->file('csv_file');
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0); // If your CSV file has a header row

        $users = $csv->getRecords(); // Get each row as an associative array

        foreach ($users as $row) {
            // Extract email prefix and create password
            $emailPrefix = explode('@', $row['email'])[0];
            $password = $emailPrefix . '@123';

            // Create the user
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'mobile' => $row['mobile_number'],
                'city' => $row['city'],
                'state' => $row['state'],
                'country' => $row['country'],
                'password' => Hash::make($password),
            ]);
        }

        return redirect()->back()->with('success', 'Users have been successfully added from CSV.');
    }
    public function blockUsers(Request $request)
    {
        if ($request->ajax()) {
            $counter = 0;
            $users = User::with('role')->where(['status' => '0'])->get(); // Assuming 'role' is a relationship
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('id', function () use (&$counter) {
                    return ++$counter;
                })
                ->addColumn('role', function ($user) {
                    return $user->role ? $user->role->name : 'N/A'; // Return role name or N/A if no role
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('block-users.update', $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.setting.blocked_users');
    }
    public function blockUpdate(Request $request, $id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->status = '1';
            $user->update();
            return redirect()->route('admin.block-user')->with('success', 'User has been activated successfully.');
        } else {
            return redirect()->route('admin.block-user')->with('error', 'Something went.');
        }
    }
}