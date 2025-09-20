<?php

namespace Database\Seeders;

use App\Models\Dictionaries\DictionaryIcon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictionaryIconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DictionaryIcon::query()->delete();

        $path = base_path() . '/database/seeders/sql/dictionary_icons.sql';

        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }
}
