<?php

namespace App\Models;

use App\Models\DetailTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total',
    ];

    public function detailTransactions() {
        return $this->hasMany(DetailTransaction::class);
    }
}
