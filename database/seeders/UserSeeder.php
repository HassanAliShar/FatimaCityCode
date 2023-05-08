<?php

namespace Database\Seeders;

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
        DB::table('users')->insert(
            [
                'name'=>'Admin',
                'email'=>'admin@rufitown.com',
                'mobile_no'=>'923063883430',
                'password'=>Hash::make('12345678'),
                'role_id'=>1,
            ]
        );
    }
}
