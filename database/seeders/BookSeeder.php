<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $batchSize = 5000;
        $total = 100000;

        $authors = DB::table('authors')->pluck('id')->toArray();
        $categories = DB::table('categories')->pluck('id')->toArray();

        $data = [];
        for ($i = 1; $i <= $total; $i++) {
            $data[] = [
                'title' => $faker->sentence(3),
                'author_id' => $faker->randomElement($authors),
                'category_id' => $faker->randomElement($categories),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % $batchSize === 0) {
                DB::table('books')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('books')->insert($data);
        }
    }
}
