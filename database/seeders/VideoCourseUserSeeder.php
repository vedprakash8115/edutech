<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VideoCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoCourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role_id', '4')->get();
        $videoCourses = VideoCourse::all();
    
        foreach ($students as $student) {
            $student->purchasedCourses()->attach(
                $videoCourses->random(rand(1,3))->pluck('id')->toArray()
            );
        }
    }
}
