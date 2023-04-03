<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => 1,
            'title' => 'Reject Degeneracy & Embrace God.',
            'author' => 'Hamza',
            'tag_time' => "11:11",
            'subtitle' => 'L\'exemple d\'un subtitle...',
            'link' => 'https://www.youtube.com/watch?v=-QdoEt_Qdxo',
        ];
    }
}
