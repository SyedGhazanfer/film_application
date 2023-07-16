<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

$faker = Faker::create();
class FilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create three films
        $faker = Faker::create();
        for ($i = 0; $i < 3; $i++) {
            $film =   Film::create([
                'name' => $faker->sentence,
                'description' => 'Description ' . $i,
                'release_date' => $faker->date,
                'rating' => $faker->randomElement([1, 2, 3, 4, 5]),
                'price' => $faker->randomFloat(2, 9.99, 19.99),
                'user_id' => 1,
                'country' => $faker->country,
                'genre' => $faker->randomElement(['Action', 'Drama', 'Comedy']),
            ]);

            Comment::create([
                'film_id' => $film->id,
                'user_id' => 1,
                'comments' => "Amazing Movie"
            ]);
        }
    }
}
