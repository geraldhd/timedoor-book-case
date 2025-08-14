<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $batchSize = 2000;
        $total = 1000;

        $data = [];
        for ($i = 1; $i <= $total; $i++) {
            $data[] = [
                'name' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % $batchSize === 0) {
                DB::table('authors')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('authors')->insert($data);
        }
    }
}
