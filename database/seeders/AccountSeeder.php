<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'password'=>bcrypt('admin123'),
                'first_name' => 'Beo',
                'last_name' => 'Phat',
                'dob' => '2000-09-13',
                'id_card'=>'07000003692',
                'gender' => 'male',
                'email'=>'pvphat12c6ntt@gmail',
                'phone_number'=>'0937175474',
                'is_verify'=>true,
                'role_id' => 'd681bad7-0591-4f74-bbd9-8a70c8fa34aa',
                'modified_by_id' =>'59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
    ]);
    }
}
