<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carousel extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'image_carousel',
        'title_carousel',
        'description_carousel',
        'is_active',
    ];

    protected $hidden = [
        
    ];
}
