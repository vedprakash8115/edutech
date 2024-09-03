<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSubCategory extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }
}
