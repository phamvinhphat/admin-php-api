<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $dataDoc = DB::table('document')->select('id')->pluck('id');

        $dataStatus = DB::table('status')->select('id')->pluck('id');



        foreach ($dataDoc as $docId )
        {

            foreach ($dataStatus as $statusId)
            {
                DB::table('workflow')->insert([
                    // status new
                    [
                        'id' => $faker->uuid(),
                        'status_id' => $statusId,
                        'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                        'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                        'document_id' => $docId,
                        'created_at' => date_create(),
                        'updated_at' => date_create(),
                    ]
                ],
                );
            }


        }

    }
}
