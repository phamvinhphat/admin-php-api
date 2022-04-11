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
        DB::table('workflow')->insert([
            // status new
            [
                'id' => 'ea474d12-5968-459b-a46b-a90777a26fd0',
                'status_id' => '9ca64038-f223-438a-8949-3948be633090',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'document_id' => '0f009fb2-6dbd-4f62-a05d-0c8cd9123779',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            // status loading
            [
                'id' => '5fcd6ad4-a6d9-4d4b-8a7c-4a3058bf4533',
                'status_id' => '115e56c6-d6ba-44aa-8783-d9cb08fdd6e1',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'document_id' => 'c6acbb29-ec04-405c-bedd-4ac967f68aaa',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            // status done
            [
                'id' => 'cf9040a3-e930-4c75-8dbb-ca15f2cfe99b',
                'status_id' => 'd37fa85f-7fcc-4a63-99ba-4e17c542baa9',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'document_id' => 'a2fff3b1-6123-4c94-9375-8423093c77e3',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],
            //done
            [
                'id' => '622f7a3e-3b6e-4bba-9b08-f794ef4894f7',
                'status_id' => 'd37fa85f-7fcc-4a63-99ba-4e17c542baa9',
                'modified_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'created_by_id' => '59bf2cc1-4e00-4604-94dc-a9fb16247984',
                'document_id' => '2f0a7913-cfc1-44e0-997f-2f73be8393e2',
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ],

        ]);
    }
}
