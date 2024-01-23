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
        $harga = 87000;
        return [
            'nama' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'deskripsi' => $this->faker->paragraph(mt_rand(5,10)),
            'harga' => $harga,
            'stok' => 87,
            'hargaTotal' => $harga,
        ];
    }
}
