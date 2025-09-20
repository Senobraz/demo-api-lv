<?php

namespace Database\Seeders;

use App\Models\Dictionaries\DictionaryColor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenerateUlidForColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (DictionaryColor::all() as $icon) {
            if(!$icon->ulid) {
                $icon->ulid = (string) strtolower(Str::ulid());

                $icon->save();
            }
        }
    }
}
