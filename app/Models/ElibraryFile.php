<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ElibraryFile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['elibrary_id', 'file_path'];

    public function elibrary()
    {
        return $this->belongsTo(Elibrary::class);
    }
}
