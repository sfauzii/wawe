<?php

namespace App\Models;

use App\Models\Transaction;
use App\Models\TravelPackage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'transactions_id',
        'username',
        'phone',
        // 'nationality', 'is_visa', 'doe_passport'
    ];

    protected $hidden = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }

    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class, 'travel_packages_id');
    }
}
