<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;
    protected $table = 'queries';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ticket_id',
        'sender_id',
        'message'
    ];

    // Message belongs to a ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Message belongs to a sender (either a student or a support agent)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class , 'query_id');
    }
}