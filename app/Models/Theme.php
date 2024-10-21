<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'preview_image', 'path', 'is_active'];

    /**
     * Get the active theme.
     */
    public static function getActiveTheme()
    {
        return self::where('is_active', true)->first();
    }
}
