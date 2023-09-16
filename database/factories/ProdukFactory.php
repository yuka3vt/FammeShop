<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            

            'nama' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'deskripsi' => $this->faker->paragraph(mt_rand(5,10)),
            'harga' => 87000,
            'stok' => 87,
            'produkwarna_id' => 1,
            'produkukuran_id' => 1,
        ];
    }
}
