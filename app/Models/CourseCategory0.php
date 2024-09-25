<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory0 extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    
    public function Courses()
    {
        return $this->hasMany(CourseCategory::class);
    }
    public function VideoCourses()
    {
        return $this->hasMany(VideoCourse::class, 'course_category_id');
    }
}
