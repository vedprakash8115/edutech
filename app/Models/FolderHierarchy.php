<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderHierarchy extends Model
{
    use HasFactory;
    protected $table = 'folder_hierarchy'; // Closure table name
    protected $guarded = [];

    public function ancestor()
    {
        return $this->belongsTo(Folder::class, 'ancestor_id');
    }

    public function descendant()
    {
        return $this->belongsTo(Folder::class, 'descendant_id');
    }
}
