<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    // public function course()
    // {
    //     return $this->belongsTo(VideoCourse::class);
    // }
    public function videoCourse()  // Changed from course() to videoCourse() for consistency
    {
        return $this->belongsTo(VideoCourse::class, 'videocourse_id');  // Specify the foreign key
    }
}
