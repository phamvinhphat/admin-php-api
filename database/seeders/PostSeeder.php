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
        DB::table('post')->insert([
            [
                'id' => Uuid::uuid4()->toString(),
                'contents' => 'Home',
                'longitude' => '12536.12563',
                'latitude' => '1475.3695',
                'price' => '20000',
                'floor_area' => '123458 ',
                'address' => 'HCM',
                'furniture_status' => 'good',
                'views' => 2,
                'document_id'=>'a2fff3b1-6123-4c94-9375-8423093c77e3',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'contents' => 'TomCode',
                'longitude' => '12536.12563',
                'latitude' => '1475.3695',
                'price' => '20000',
                'floor_area' => '123458 ',
                'address' => 'CanGio',
                'furniture_status' => 'good',
                'views' => 2,
                'document_id'=>'2f0a7913-cfc1-44e0-997f-2f73be8393e2',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' =>'59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
        ]);
    }
}
