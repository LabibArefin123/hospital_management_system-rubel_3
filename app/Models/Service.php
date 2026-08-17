<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'instructions'
    ];

    protected $casts = [
        'instructions' => 'array'
    ];
}
