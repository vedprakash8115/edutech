<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubject extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'subject_id', 'weight'];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
