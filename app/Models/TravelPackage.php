<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'about',
        'features',
        'departure_date',
        'duration',
        'kuota',
        'type',
        'price',
        'is_active',
        'discount_percentage', // New attribute for discount percentage
        'original_price', // New attribute for discount percentage
    ];

    protected $hidden = [];

    // Method to calculate discounted price
    public function getDiscountedPriceAttribute()
    {
        return $this->price - ($this->price * ($this->discount_percentage / 100));
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'travel_packages_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'travel_packages_id');
    }
}
