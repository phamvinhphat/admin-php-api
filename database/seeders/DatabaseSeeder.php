<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(RolePermissionsSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(WorkflowSeeder::class);
        $this->call(PostSeeder::class);
    }
}
