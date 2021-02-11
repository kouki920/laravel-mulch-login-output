<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'type' => '新規',
            ],
            [
                'type' => '既存',
            ],
            [
                'type' => 'なし',
            ],

        ]);
    }
}
