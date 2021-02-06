<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'              => 'admin',
            'email'             => 'admin2@example.com',
            'password'          => Hash::make('plokij123'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
