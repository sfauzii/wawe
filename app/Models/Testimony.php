<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimony extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'testimonies';

    protected $fillable = ['users_id', 'transactions_detail_id', 'travel_packages_id', 'message', 'photos'];

    protected $casts = [
        'photos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function transactionDetail()
    {
        return $this->belongsTo(TransactionDetail::class, 'transactions_detail_id');
    }

    public function travelPackage()
    {
        return $this->belongsTo(TravelPackage::class, 'transactions_detail_id')->with('galleries');
    }
}
