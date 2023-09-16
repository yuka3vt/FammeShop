<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blogkategori;
use App\Models\Blog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'kutipan' => $this->faker->paragraph(),
            'isi_blog' => $this->faker->paragraph(mt_rand(5,10)),
            'user_id' => 1,
        ];
    }

}
