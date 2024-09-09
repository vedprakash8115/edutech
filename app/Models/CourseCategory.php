<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];

    // In CourseCategory.php model
    public function course()
    {
        return $this->belongsTo(CourseCategory0::class, 'course_id');
    }

}
