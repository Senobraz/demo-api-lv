<?php

namespace Database\Seeders;

use App\Models\Localizations\Localization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Localization::query()->delete();

        $path = base_path() . '/database/seeders/sql/localizations.sql';

        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }

}
