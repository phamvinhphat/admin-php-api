<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();
        $dataAlbum = DB::table('album')->select('id')->pluck('id');
        $dataDoc = DB::table('document')->select('id')->pluck('id');

        // foreach ($dataAlbum as $albumId) {
        foreach ($dataDoc as $docId) {
            DB::table('post')->insert([
                [
                    'id' => $faker->uuid,
                    'contents' => $faker->text(200),
                    'longitude' => $faker->longitude(),
                    'latitude' =>  $faker->latitude(),
                    'price' => $faker->numberBetween(500000, 10000000),
                    'floor_area' => $faker->numberBetween(10, 500),
                    'furniture_status' => $faker->randomElement(['None', 'Fairly', 'Functional', 'Good']),
                    'views' => $faker->numberBetween(5000, 100000),
                    'document_id' => $docId,
                    'album_id' => null,
                    'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                    'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                    'created_at' => date_create(),
                    'updated_at' => date_create(),
                ],
            ]);
        }
        // }
    }
}
