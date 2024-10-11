<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index($groupId) {
        try {

            $data = $this->getGroupData($groupId); 

            Log::info($data['messages']);
            // Return a view with all relevant data
            return view('ins.content.chat-support.message', $data);
        } catch (\Exception $e) {
            // Log the error
            return back()->with('error', 'Something went wrong.');
        }
    }
    
    


    // Method to store a new message
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'content' => 'required|string|max:255',
            'group_id' => 'required|exists:groups,id', // Ensure group ID exists
        ]);

        // Create a new message instance
        $message = new Message();
        $message->content = $request->input('content');
        $message->group_id = $request->input('group_id');
        $message->user_id = auth()->id(); // Assuming you want to associate the message with the authenticated user
        $message->is_sent = true; // Set to true, assuming it's a sent message
        $message->save(); // Save the message to the database

        broadcast(new MessageSent($message))->toOthers();
        // Optionally, return a response (you might want to return the created message)
        return response()->json(['message' => 'Message sent successfully!', 'data' => $message], 201);
    }
    public function addPeopleToGroup(Request $request, $groupId)
    {
        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:users,id', // Validate that user IDs exist
        ]);
        
        // Find the group
        $group = Group::findOrFail($groupId);
    
        // Attach users to the group
        $group->users()->attach($request->students);
    
        // Optionally, you could return a success response or redirect
        return response()->json(['success' => true],200);

    }

    public function availableStudents($groupId)
    {
        try {
            $data = $this->getGroupData($groupId);  
            $availableStudents = $data['availableStudents'];
            return response()->json(['success'=> true,'data'=> $availableStudents],200);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching available students: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch available students'], 500);
        }
    }


    private function getGroupData($groupId)
    {


        $group = Group::with('teacher')->findOrFail($groupId); // Load the group with the teacher relationship
        $messages = Message::with('user')->where('group_id', $groupId)->orderBy('created_at', 'asc')->get();
        $videoCourseId = $group->video_course_id;
        if ($group->teacher && $group->teacher->role_id === 3) {
            $teacherName = $group->teacher->name;
        } else {
            // Handle the case where the teacher is not valid
            $teacherName = 'No valid teacher assigned';
        }
        
        
        // Fetch students who have purchased the specific video course
        $students = User::whereHas('purchasedCourses', function ($query) use ($videoCourseId) {
            $query->where('video_course_id', $videoCourseId);
        })->get();

        // Get the users already in the group
        $groupMembers = DB::table('users')
            ->join('group_user', 'users.id', '=', 'group_user.user_id')
            ->where('group_user.group_id', $groupId)
            ->whereNull('users.deleted_at')
            ->select('users.id') // specify the table name for clarity
            ->pluck('id')
            ->toArray();

        // Filter available students (those not already in the group)
        $availableStudents = $students->whereNotIn('id', $groupMembers);
        

        return compact('group', 'messages', 'availableStudents', 'videoCourseId','teacherName');
    }

    public function getAvailableTeachers()
    {
        // Fetch all teachers from the users table
        $teachers = User::where('role_id', '3')->get(); // Assuming you have a role column in your users table

        return response()->json(['teachers' => $teachers]);
    }

    public function assignTeacher(Request $request, $groupId)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id'// Ensure the teacher exists in the users table
        ]);
    
        // Find the group
        $group = Group::findOrFail($groupId);
    
        // Update the teacher_id in the group
        $teacherName = User::findOrFail($request-> teacher_id)-> name;
        $group->teacher_id = $request->teacher_id;
        $group->save(); // Save the changes
    
        // Return a success response
        return response()->json(['success' => true, ['teacher_id' => $group->teacher_id,'teacher_name'=> $teacherName]]);
    }
    public function test(Request $request){
        Log::info($request);
    }

}

