<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account')->insert([
            [
                'id'=>'59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'username' => 'admin',
                'password'=>Hash::make('admin123'),
                'first_name' => 'Beo',
                'last_name' => 'Phat',
                'dob' => '2000-09-13',
                'id_card'=>'07000003692',
                'gender' => 'male',
                'email'=>'pvphat12c6ntt@gmail.com',
                'phone_number'=>'0937175474',
                'is_verify'=>true,
                'is_admin'=>true,
                'role_id' => 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'modified_by_id' =>'59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            [
                'id'=>'fe1294a0-4485-4c1c-8ef3-1a7c5dd62dae',
                'username' => 'user123',
                'password'=>Hash::make('user123'),
                'first_name' => 'map',
                'last_name' => 'Phac',
                'dob' => '2000-09-13',
                'id_card'=>'07000002236',
                'gender' => 'male',
                'email'=>'pvphat12c6@gmail.com',
                'phone_number'=>'0937175482',
                'is_verify'=>true,
                'is_admin'=>false,
                'role_id' => '766be67a-6520-4968-85ea-e9e07daf4e53',
                'modified_by_id' =>'59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
    ]);
    }
}
