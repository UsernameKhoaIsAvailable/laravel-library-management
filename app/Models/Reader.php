<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'dob',
        'id_number',
        'address',
        'number_of_books_borrowed',
    ];

    protected $casts = [
        'dob' => 'date',
        'number_of_books_borrowed' => 'integer',
        'gender' => 'boolean',
    ];

    public function scopeSimpleSearch(Builder $query, string $search): Builder
    {
        $search = "%" . strtolower($search) . "%";
        return $query->whereRaw('LOWER(name) LIKE ?', [$search])
                     ->orWhereRaw('LOWER(id_number) LIKE ?', [$search])
                     ->orWhereRaw('LOWER(address) LIKE ?', [$search]);
    }
}
