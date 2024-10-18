<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class liveClass extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
    // public function getCourseDurationAttribute($value)
    // {
    //     if ($value) {
    //         return Carbon::parse($value)->format('H:i:s');
    //     }
    //     return null;
    // }

    public function folders()
    {
        return $this->belongsToMany(Folder::class, 'folder_liveclass');
    }
    
}
