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

        $permissions = DB::table('permission')->get(['id', 'name']);
        $admin = DB::table('role')->where('name', 'like', 'Admin')->first();
        $user = DB::table('role')->where('name', 'like', 'User')->first();

        foreach ($permissions as $p) {
            DB::table('role_permissions')->insert([
                [
                    'role_id' => $admin->id,
                    'permission_id' => $p->id,
                ]
            ]);
            if (str_contains($p->name, 'view')) {
                DB::table('role_permissions')->insert([
                    [
                        'role_id' => $user->id,
                        'permission_id' => $p->id,
                    ]
                ]);
            }
        }
    }
}
