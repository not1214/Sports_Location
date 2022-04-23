<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();

        $admins = [
            ['name' => 'admin',
             'email' => 'admin@gmail.com',
             'password' => bcrypt('11111111'),
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
             ]
        ];

        foreach ($admins as $admin) {
            DB::table('admins')->insert($admin);
        }
    }
}
