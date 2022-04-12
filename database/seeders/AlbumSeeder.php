<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 6; $i++) {
            DB::table('album')->insert([
                'id' => $faker->uuid,
                'name' => $faker->name,
                'created_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'modified_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ]);
        }

    }
}
