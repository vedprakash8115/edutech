<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'file_path'
    ];

    // Attachment belongs to a ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
