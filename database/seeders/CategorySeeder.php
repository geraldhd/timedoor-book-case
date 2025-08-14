<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $batchSize = 2000;
        $total = 3000;

        $data = [];
        for ($i = 1; $i <= $total; $i++) {
            $data[] = [
                'name' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % $batchSize === 0) {
                DB::table('categories')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('categories')->insert($data);
        }
    }
}
