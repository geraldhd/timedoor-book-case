<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $batchSize = 5000;
        $total = 500000;

        $books = DB::table('books')->pluck('id')->toArray();

        $data = [];
        for ($i = 1; $i <= $total; $i++) {
            $data[] = [
                'book_id' => $faker->randomElement($books),
                'rating' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % $batchSize === 0) {
                DB::table('ratings')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('ratings')->insert($data);
        }
    }
}
