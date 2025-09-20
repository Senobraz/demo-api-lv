<?php

namespace App\Modules\Enotes\Database\Factories;

use App\Helpers\SortHelper;
use App\Modules\Enotes\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->text(100),
            'parent_id' => null,
            'level' => 0,
            'type' => Section::TYPE_DEFAULT,
            'status' => Section::STATUS_DEFAULT,
            'description' => fake()->text(400),
            'sort' => SortHelper::getSortValue(),
            'color_id' => null,
            'icon_id' => null,
            'file_id' => null,
        ];
    }
}
