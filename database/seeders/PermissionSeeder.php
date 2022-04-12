<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = ['permission', 'role', 'account', 'document', 'status', 'album', 'workflows', 'image', 'posts', 'comment', 'conversations', 'attachment', 'message', 'member'];
        $action = ['create', 'update', 'view', 'delete'];

        foreach($model as $m) {
            foreach($action as $a) {
                DB::table('permission')->insert([
                    [
                        'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                        'name' => "$m.$a",
                        'created_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                        'modified_by_id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                        'created_at' => date_create(),
                        'updated_at' => date_create(),
                    ],
                ]);
            }
        }
    }
}
