<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VideoCourse extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'video_course_user')->withTimestamps();
    }



}
