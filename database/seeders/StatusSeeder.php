<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            [
                'id' => '9ca64038-f223-438a-8949-3948be633090',
                'name' => 'Start',
                'parent_n' => null,
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id' => '115e56c6-d6ba-44aa-8783-d9cb08fdd6e1',
                'name' => 'Node',
                'parent_n' => '9ca64038-f223-438a-8949-3948be633090',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id' => 'd37fa85f-7fcc-4a63-99ba-4e17c542baa9',
                'name' => 'Public',
                'parent_n' => '115e56c6-d6ba-44aa-8783-d9cb08fdd6e1',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id' => '1514e911-469b-47e6-a5f4-2fc6dccd2dd8',
                'name' => 'Remove',
                'parent_n' => '115e56c6-d6ba-44aa-8783-d9cb08fdd6e1',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
        ]);
    }
}
