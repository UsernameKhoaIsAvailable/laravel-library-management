<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'borrow_date',
        'number_of_transaction_lines',
        'is_completed',
        'reader_id',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'is_completed' => 'boolean',
    ];

    protected $attributes = [
        'borrow_date' => null,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if ($transaction->borrow_date === null) {
                $transaction->borrow_date = Carbon::now();
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
