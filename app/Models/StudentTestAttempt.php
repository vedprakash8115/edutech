<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id', 'student_id', 'start_time', 'end_time', 'total_score',
        'is_passed', 'attempt_number', 'feedback'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
