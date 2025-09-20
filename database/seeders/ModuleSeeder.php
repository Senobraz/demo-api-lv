<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            [
                'code' => 'guide',
                'name' => 'Guide',
            ],
            [
                'code' => 'enotes',
                'name' => 'Enotes',
            ],
        ]);
    }
}
