<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
                // Specify which attributes are mass assignable
    protected $guarded = [];
    public function videoCourse()
    {
        return $this->belongsTo(VideoCourse::class);
    }

    // A folder can contain other nested folders
    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_folder_id');
    }

    // A folder can belong to a parent folder (for nested folders)
    public function parentFolder()
    {
        return $this->belongsTo(Folder::class, 'parent_folder_id');
    }

    // A folder can have multiple files
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
