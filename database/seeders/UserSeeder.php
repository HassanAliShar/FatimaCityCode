<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'email'=>'admin@newfatimacity.com',
                'mobile_no'=>'923063883430',
                'password'=>sha1('12345@aA'),
                'role_id'=>1,
            ]
        );
    }
}
