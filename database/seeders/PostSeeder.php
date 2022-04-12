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

        $dataDoc = DB::table('document')->value('id');

        foreach ($dataAlbum as $albumId ) {
         foreach ($dataDoc as $docId) {
             DB::table('post')->insert([
                 [
                         'id' => $faker->uuid,
                         'contents' => 'Home',
                         'longitude' => '12536.12563',
                         'latitude' => '1475.3695',
                         'price' => '20000',
                         'floor_area' => '123458 ',
                         'furniture_status' => 'good',
                         'views' => 2,
                         'document_id' => $docId,
                         'album_id' => $albumId,
                         'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                         'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                         'created_at' => date_create(),
                         'updated_at' => date_create(),
                ],
             ]);
            }
        }
    }
}
