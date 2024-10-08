<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subject_teacher extends Model
{
    use HasFactory;
    protected $table = 'subject_teacher';

    protected $guarded = [];
    
}
