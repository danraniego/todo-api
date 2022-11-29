<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Dan Walker',
                'email' => 'danraniego@gmail.com',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'Mark Gaje',
                'email' => 'markgaje43@gmail.com',
                'password' => bcrypt('mark123')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
