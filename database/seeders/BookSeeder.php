<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'name' => 'The Lord of the Rings',
                'category' => 'Fantasy',
                'author' => 'J.R.R. Tolkien',
                'language' => 'English',
                'quantity' => 10,
            ],
            [
                'name' => 'Pride and Prejudice',
                'category' => 'Romance',
                'author' => 'Jane Austen',
                'language' => 'English',
                'quantity' => 5,
            ],
            // ... add 18 more books
             [
                'name' => 'The Hitchhiker\'s Guide to the Galaxy',
                'category' => 'Science Fiction',
                'author' => 'Douglas Adams',
                'language' => 'English',
                'quantity' => 7,
            ],
            [
                'name' => 'To Kill a Mockingbird',
                'category' => 'Classic',
                'author' => 'Harper Lee',
                'language' => 'English',
                'quantity' => 12,
            ],
            [
                'name' => '1984',
                'category' => 'Dystopian',
                'author' => 'George Orwell',
                'language' => 'English',
                'quantity' => 8,
            ],
            [
                'name' => 'The Great Gatsby',
                'category' => 'Classic',
                'author' => 'F. Scott Fitzgerald',
                'language' => 'English',
                'quantity' => 15,
            ],
            [
                'name' => 'One Hundred Years of Solitude',
                'category' => 'Magical Realism',
                'author' => 'Gabriel García Márquez',
                'language' => 'Spanish',
                'quantity' => 6,
            ],
            [
                'name' => 'Moby-Dick',
                'category' => 'Adventure',
                'author' => 'Herman Melville',
                'language' => 'English',
                'quantity' => 9,
            ],
            [
                'name' => 'The Catcher in the Rye',
                'category' => 'Coming-of-age',
                'author' => 'J.D. Salinger',
                'language' => 'English',
                'quantity' => 11,
            ],
            [
                'name' => 'The Odyssey',
                'category' => 'Epic Poetry',
                'author' => 'Homer',
                'language' => 'Greek',
                'quantity' => 4,
            ],
            [
                'name' => 'Hamlet',
                'category' => 'Tragedy',
                'author' => 'William Shakespeare',
                'language' => 'English',
                'quantity' => 13,
            ],
            [
                'name' => 'The Little Prince',
                'category' => 'Children\'s Literature',
                'author' => 'Antoine de Saint-Exupéry',
                'language' => 'French',
                'quantity' => 16,
            ],
            [
                'name' => 'And Then There Were None',
                'category' => 'Mystery',
                'author' => 'Agatha Christie',
                'language' => 'English',
                'quantity' => 10,
            ],
             [
                'name' => 'The Da Vinci Code',
                'category' => 'Thriller',
                'author' => 'Dan Brown',
                'language' => 'English',
                'quantity' => 18,
            ],
            [
                'name' => 'The Alchemist',
                'category' => 'Fiction',
                'author' => 'Paulo Coelho',
                'language' => 'English',
                'quantity' => 7,
            ],
            [
                'name' => 'Sapiens',
                'category' => 'Non-Fiction',
                'author' => 'Yuval Noah Harari',
                'language' => 'English',
                'quantity' => 12,
            ],
             [
                'name' => 'Thinking, Fast and Slow',
                'category' => 'Psychology',
                'author' => 'Daniel Kahneman',
                'language' => 'English',
                'quantity' => 9,
            ],
            [
                'name' => 'The Lean Startup',
                'category' => 'Business',
                'author' => 'Eric Ries',
                'language' => 'English',
                'quantity' => 15,
            ],
             [
                'name' => 'Eloquent JavaScript',
                'category' => 'Programming',
                'author' => 'Marijn Haverbeke',
                'language' => 'English',
                'quantity' => 6,
            ],
            [
                'name' => 'Learn Python the Hard Way',
                'category' => 'Programming',
                'author' => 'Zed Shaw',
                'language' => 'English',
                'quantity' => 11,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
