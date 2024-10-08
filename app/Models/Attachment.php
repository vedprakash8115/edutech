<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    // // Attachment belongs to a ticket
    // public function query()
    // {
    //     return $this->belongsTo(Query::class);
    // }
}
