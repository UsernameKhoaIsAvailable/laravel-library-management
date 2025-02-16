<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'category',
        'author',
        'language',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function transactionLines()
    {
        return $this->hasMany(TransactionLine::class);
    }
}
