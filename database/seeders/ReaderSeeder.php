<?php

namespace Database\Seeders;

use App\Models\Reader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $readers = [
            [
                'name' => 'John Doe',
                'gender' => true, // Male
                'dob' => '1990-05-15',
                'id_number' => '1234567890',
                'address' => '123 Main St',
                'number_of_books_borrowed' => 0,
            ],
            [
                'name' => 'Jane Smith',
                'gender' => false, // Female
                'dob' => '1995-11-20',
                'id_number' => '9876543210',
                'address' => '456 Oak Ave',
                'number_of_books_borrowed' => 0,
            ],
             [
                'name' => 'David Lee',
                'gender' => true,
                'dob' => '1988-03-10',
                'id_number' => '5555555555',
                'address' => '789 Pine Ln',
                'number_of_books_borrowed' => 0,
            ],
            [
                'name' => 'Sarah Jones',
                'gender' => false,
                'dob' => '1992-07-25',
                'id_number' => '1111111111',
                'address' => '101 Elm St',
                'number_of_books_borrowed' => 0,
            ],
            [
                'name' => 'Michael Brown',
                'gender' => true,
                'dob' => '1997-01-05',
                'id_number' => '2222222222',
                'address' => '222 Maple Ave',
                'number_of_books_borrowed' => 0,
            ],
            [
                'name' => 'Emily Davis',
                'gender' => false,
                'dob' => '1993-09-18',
                'id_number' => '3333333333',
                'address' => '333 Willow Ln',
                'number_of_books_borrowed' => 0,
            ],
            [
                'name' => 'Christopher Wilson',
                'gender' => true,
                'dob' => '1985-06-12',
                'id_number' => '4444444444',
                'address' => '444 Birch St',
                'number_of_books_borrowed' => 0,
            ],
            [
                'name' => 'Jessica Garcia',
                'gender' => false,
                'dob' => '1991-12-08',
                'id_number' => '6666666666',
                'address' => '555 Oak Ave',
                'number_of_books_borrowed' => 0,
            ],
             [
                'name' => 'Matthew Rodriguez',
                'gender' => true,
                'dob' => '1996-04-22',
                'id_number' => '7777777777',
                'address' => '666 Pine Ln',
                'number_of_books_borrowed' => 0,
            ],
            [
                'name' => 'Ashley Martinez',
                'gender' => false,
                'dob' => '1989-10-29',
                'id_number' => '8888888888',
                'address' => '777 Elm St',
                'number_of_books_borrowed' => 0,
            ],
        ];

        foreach ($readers as $reader) {
            Reader::create($reader);
        }
    }
}
