<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graphics extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'logo_width',
        'logo_height',
        'background_color',
        'gradient_color_2',
        'custom_text',
        'text_size',
        'text_color',
        'custom_url',
        'condition',
        'from_date',
        'to_date',
        'from_time',
        'to_time',
        'interval',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'from_time' => 'datetime',
        'to_time' => 'datetime',
    ];
}
