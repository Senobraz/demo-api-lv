<?php

namespace Database\Seeders;

use App\Models\Dictionaries\DictionaryColor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionaryColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DictionaryColor::query()->delete();

        $path = base_path() . '/database/seeders/sql/dictionary_colors.sql';

        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }
}
