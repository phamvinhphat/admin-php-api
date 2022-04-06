<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->insert([
            // admin
            // permission delete
            [
                'role_id'=> 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'permission_id' => '1905d138-70dd-4ae2-807d-fa47cd3f1c68',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            // permission edit
            [
                'role_id'=> 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'permission_id' => 'c9074b9c-7c6d-4025-a4fd-896614f19799',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            // permission view
            [
                'role_id'=> 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'permission_id' => 'a9794e38-5fea-4e0f-9260-09b5a2c37474',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            // permission create
            [
                'role_id'=> 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'permission_id' => '31c8620f-fc71-48e7-ad8c-110137a8bc6a',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],

            // user
            // permission view
            [
                'role_id'=> '766be67a-6520-4968-85ea-e9e07daf4e53',
                'permission_id' => 'a9794e38-5fea-4e0f-9260-09b5a2c37474',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],

        ]);
    }
}
