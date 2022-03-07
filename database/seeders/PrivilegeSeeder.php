<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Privilege')->insert([
            [
                'id' => 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'name' => 'admin',
                'created_by' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id' => '766be67a-6520-4968-85ea-e9e07daf4e53',
                'name' => 'user',
                'created_by' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ]
        ]);
    }
}
