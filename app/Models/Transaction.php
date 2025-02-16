<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'borrow_date',
        'number_of_transaction_lines',
        'is_complete',
        'reader_id',
    ];

    protected $casts = [
        'borrow_date' => 'date', 
        'is_complete' => 'boolean',
    ];

    protected $attributes = [
        'borrow_date' => null,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if ($transaction->borrow_date === null) {  // Only set if not already provided
                $transaction->borrow_date = Carbon::now(); // Use Carbon to get current time
            }
        });
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    public function transactionLines()
    {
        return $this->hasMany(TransactionLine::class);
    }
}
