<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApproachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('approaches')->insert([
            [
                'method' => '訪問',
            ],
            [
                'method' => '紹介',
            ],
            [
                'method' => '電話',
            ],
            [
                'method' => 'zoom',
            ],
            [
                'method' => 'なし',
            ],
        ]);
    }
}
