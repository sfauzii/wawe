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
        // 'kuota',
        'type',
        'price',
        'is_active',
    ];

    protected $hidden = [];

    // Accessor for image
    public function getImageAttribute($value)
    {
        if (empty($value)) {
            return ['https://via.placeholder.com/150'];
        }

        return is_array($value) ? $value : [$value];
    }


    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'travel_packages_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'travel_packages_id');
    }

    // public function users()
    // {
    //     return $this->hasManyThrough(User::class, Transaction::class, 'travel_packages_id', 'id', 'id', 'users_id');
    // }
}
