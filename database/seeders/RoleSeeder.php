<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [
                'id' => 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'name' => 'ADMIN',
                'created_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id' => '766be67a-6520-4968-85ea-e9e07daf4e53',
                'name' => 'USER',
                'created_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
        ]);
    }
}
