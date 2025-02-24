<?php

namespace Database\Seeders;

use App\Models\Reader;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReaderSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $existingReaders = [];

        $readersToCreate = 90; // Calculate how many more to create

        for ($i = 0; $i < $readersToCreate; $i++) {
            $gender = $faker->boolean;
            $name = $gender ? $faker->name('female') : $faker->name('male');
            $dob = $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d');
            $idNumber = $faker->unique()->numerify('##########');
            $address = $faker->address;
            $numberOfBooksBorrowed = 0;

            // Check for duplicates *before* creating
            $isDuplicate = false;
            foreach ($existingReaders as $existingReader) {
                if ($existingReader['name'] === $name && $existingReader['gender'] === $gender && $existingReader['dob'] === $dob && $existingReader['id_number'] === $idNumber && $existingReader['address'] === $address) {
                    $isDuplicate = true;
                    break;
                }
            }

            if (!$isDuplicate) {
                Reader::create([
                    'name' => $name,
                    'gender' => $gender,
                    'dob' => $dob,
                    'id_number' => $idNumber,
                    'address' => $address,
                    'number_of_books_borrowed' => $numberOfBooksBorrowed,
                ]);

                $existingReaders[] = [ // Add to existing readers to prevent duplicates in the same run.
                    'name' => $name,
                    'gender' => $gender,
                    'dob' => $dob,
                    'id_number' => $idNumber,
                    'address' => $address,
                    'number_of_books_borrowed' => $numberOfBooksBorrowed,
                ];
            }
        }

        echo "Created " . $readersToCreate . " readers.\n";
    }
}
