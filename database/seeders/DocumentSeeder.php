<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

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

        $data = `{ "id": '$faker->uuid',
         "contents": '$faker->title',
         "longitude: " '$faker->longitude',
         "latitude:" '$faker->latitude',
         "price:" '$faker->imei',
         "floor_area:" '$faker->title',
         "address:"'$faker->address'  }`;

        DB::table('document')->insert([
            [
                'id' => '0f009fb2-6dbd-4f62-a05d-0c8cd9123779',
                'document_code'=> 'POST',
                'data'=> ' { "id": 3, "starts": "2018-01-01", "end": "2018-06-01"}',
                'created_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'modified_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id'=>'c6acbb29-ec04-405c-bedd-4ac967f68aaa',
                'document_code'=> 'POST',
                'data'=> ' { "id": 3, "starts": "2018-01-01", "end": "2018-06-01"}',
                'created_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'modified_by_id' => 'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            //done
            [
                'id'=>'a2fff3b1-6123-4c94-9375-8423093c77e3',
                'document_code'=> 'POST',
                'data'=> ' { "id": 3, "starts": "2018-01-01", "end": "2018-06-01"}',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id'=>'2f0a7913-cfc1-44e0-997f-2f73be8393e2',
                'document_code'=> 'POST',
                'data'=> ' { "id": 3, "starts": "2018-01-01", "end": "2018-06-01"}',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id'=>'1c352c40-591f-45ca-9336-7b0721b7f319',
                'document_code'=> 'POST',
                'data'=> '{ "id": 3, "starts": "2018-01-01", "end": "2018-06-01"}',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
        ]);
    }
}
