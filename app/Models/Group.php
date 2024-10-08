<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = [];

    // A group belongs to a video course
    public function videoCourse()
    {
        return $this->belongsTo(VideoCourse::class);
    }

    // A group has many users (chat participants)
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user')->withTimestamps();
    }

    // Group.php (Group model)

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id')->where('role_id', '3');
    }


    // A group can have many chat messages
    // public function messages()
    // {
    //     return $this->hasMany(Message::class);
    // }
}
