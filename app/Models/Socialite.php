<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Socialite extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'socialites';

    protected $fillable = [
        'user_id',
        'provider_id',
        'provider_name',
        'provider_token',
        'provider_refresh_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
