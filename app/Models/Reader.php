<?php

namespace App\Models;

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
}
