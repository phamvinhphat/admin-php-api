<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 3; $i++) {
            $data = [
                "id" => $faker->uuid,
                "contents" => $faker->title,
                "longitude" => $faker->longitude,
                "latitude" => $faker->latitude,
                "price" => $faker->imei,
                "floor_area" => $faker->title,
                "furniture_status" => "good",
                "views" => 2 ,
                "created_by_id" => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                "modified_by_id" => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae'
            ];

            DB::table('document')->insert([
                'id' => $faker->uuid,
                'document_code' => 'POST',
                'data' => json_encode($data),
                'created_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'modified_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ]);
        }
    }
}
