<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course_subject;
use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use App\Models\VideoCourse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){

        $videoCourses = VideoCourse::all();
        return view('ins.content.chat-support.chats',compact('videoCourses'));
    }

    public function chatRoom($videoCourseId)
    {
        // Fetch groups associated with the specific video course
        $groups = Group::where('video_course_id', $videoCourseId)->get();

        // Fetch subjects associated with the specific video course
        $subjects = Course_subject::where('video_course_id', $videoCourseId)->get();

        // Fetch students who have purchased the specific video course
        $students = User::whereHas('purchasedCourses', function ($query) use ($videoCourseId) {
            $query->where('video_course_id', $videoCourseId);
        })->get();

        // Pass all the data to the view
        return view('ins.content.chat-support.chatroom', compact('groups', 'subjects', 'students', 'videoCourseId'));
    }


    public function storeGroup(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'video_course_id' => 'required|exists:video_courses,id',
        ]);
    
        // Create the group
        Group::create([
            'name' => $request->name,
            'video_course_id' => $request->video_course_id,
        ]);
    
        return back()->with('success', 'Group created successfully!');
    }

    public function assignTeacher(Request $request, $groupId)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
        ]);

        // Find the group
        $group = Group::findOrFail($groupId);

        // Attach the teacher to the group
        // Assuming one teacher per group
        $group->teachers()->sync([$request->teacher_id]);

        return response()->json(['success' => true, 'message' => 'Teacher assigned successfully']);
    }

    
    


}
