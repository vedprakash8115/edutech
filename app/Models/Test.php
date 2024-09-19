<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title', 'description', 'duration', 'total_marks', 'difficulty_level',
    //     'passing_score', 'is_active', 'test_type', 'creation_date', 'expiry_date',
    //     'time_limit', 'is_randomized', 'has_negative_marks', 'negative_marks',
    //     'allow_multiple_attempts', 'max_attempts'
    // ];
    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function testSubjects()
    {
        return $this->hasMany(TestSubject::class);
    }

    public function studentTestAttempts()
    {
        return $this->hasMany(StudentTestAttempt::class);
    }
}
