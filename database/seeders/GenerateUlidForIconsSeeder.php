<?php

namespace Database\Seeders;

use App\Models\Dictionaries\DictionaryIcon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenerateUlidForIconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (DictionaryIcon::all() as $icon) {
            if(!$icon->ulid) {
                $icon->ulid = (string) strtolower(Str::ulid());

                $icon->save();
            }
        }
    }
}
