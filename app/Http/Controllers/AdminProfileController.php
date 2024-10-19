<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;   
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
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
        ]);

        $admin = request()->user(); 
        $admin->update($request->all());

        return redirect()->back()->with('success', 'Profile updated successfully!');
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