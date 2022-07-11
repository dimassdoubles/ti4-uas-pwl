<?php

namespace App\Models;

use App\Models\DetailTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'stock', 'description', 'image',
    ];

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
