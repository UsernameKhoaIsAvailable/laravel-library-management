<?php

namespace Database\Seeders;

use App\Models\Book;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $existingBooks = [];

        $categories = ['Fantasy', 'Romance', 'Science Fiction', 'Classic', 'Dystopian', 'Magical Realism', 'Adventure', 'Coming-of-age', 'Epic Poetry', 'Tragedy', 'Children\'s Literature', 'Mystery', 'Thriller', 'Fiction', 'Non-Fiction', 'Psychology', 'Business', 'Programming'];
        $authors = ['J.R.R. Tolkien', 'Jane Austen', 'Douglas Adams', 'Harper Lee', 'George Orwell', 'F. Scott Fitzgerald', 'Gabriel García Márquez', 'Herman Melville', 'J.D. Salinger', 'Homer', 'William Shakespeare', 'Antoine de Saint-Exupéry', 'Agatha Christie', 'Dan Brown', 'Paulo Coelho', 'Yuval Noah Harari', 'Daniel Kahneman', 'Eric Ries', 'Marijn Haverbeke', 'Zed Shaw', 'Stephen King', 'Neil Gaiman', 'Terry Pratchett', 'Isaac Asimov', 'Agatha Christie', 'J.K. Rowling', 'Ernest Hemingway', 'Leo Tolstoy', 'Virginia Woolf', 'Franz Kafka']; // Expand author list
        $languages = ['English', 'Spanish', 'French', 'Greek', 'German', 'Russian', 'Japanese', 'Chinese']; // Expand language list

        $booksToCreate = 980;
        $createdCount = 0;

        while ($createdCount < $booksToCreate) {
            $name = $faker->sentence(rand(3, 6));
            $category = $categories[array_rand($categories)];
            $author = $authors[array_rand($authors)];
            $language = $languages[array_rand($languages)];
            $quantity = rand(1, 20);

            $isDuplicate = false;
            foreach ($existingBooks as $existingBook) {
                if ($existingBook['name'] === $name && $existingBook['category'] === $category && $existingBook['author'] === $author && $existingBook['language'] === $language) {
                    $isDuplicate = true;
                    break;
                }
            }

            if (!$isDuplicate) {
                Book::create([
                    'name' => $name,
                    'category' => $category,
                    'author' => $author,
                    'language' => $language,
                    'quantity' => $quantity,
                ]);

                $existingBooks[] = [
                    'name' => $name,
                    'category' => $category,
                    'author' => $author,
                    'language' => $language,
                    'quantity' => $quantity,
                ];

                $createdCount++;
            }
        }

        echo "Created " . $createdCount . " books.\n";
    }
}
