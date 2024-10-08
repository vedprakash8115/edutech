<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'assigned_to',
        'subject',
        'priority',
        'status',
        'description'
    ];

    // Ticket belongs to a user (student)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ticket belongs to a support agent
    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Ticket belongs to a category
    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    // Ticket has many messages
    public function messages()
    {
        return $this->hasMany(Query::class);
    }

    // Ticket has many attachments
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
