<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            [
                'id'=>'1905d138-70dd-4ae2-807d-fa47cd3f1c68',
                'name' => 'document.delete',
                'created_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id'=>'c9074b9c-7c6d-4025-a4fd-896614f19799',
                'name' => 'document.edit',
                'created_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id'=> 'a9794e38-5fea-4e0f-9260-09b5a2c37474',
                'name' => 'document.view',
                'created_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id'=> '31c8620f-fc71-48e7-ad8c-110137a8bc6a',
                'name' => 'document.create',
                'created_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'modified_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
        ]);
    }
}
