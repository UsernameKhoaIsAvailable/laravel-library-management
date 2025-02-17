<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeSimpleSearch(Builder $query, string $search): Builder
    {
        $search = "%" . strtolower($search) . "%";
        return $query->whereRaw('LOWER(name) LIKE ?', [$search])
                     ->orWhereRaw('LOWER(category) LIKE ?', [$search])
                     ->orWhereRaw('LOWER(author) LIKE ?', [$search])
                     ->orWhereRaw('LOWER(language) LIKE ?', [$search]);
    }
}
