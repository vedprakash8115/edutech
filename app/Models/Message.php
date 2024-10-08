<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'user_id',
        'content',
        'type',
        'delivered_at',
        'read_at',
    ];

    // Each message belongs to a group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Each message is sent by a user (either a student or a teacher)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attachments()
    {
        return $this->hasMany(MessageAttachment::class);
    }

}
