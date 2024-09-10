<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }
    public function getSubcategories()
    {
        return $this->belongsTo(CourseSubCategory::class);
    }

}
