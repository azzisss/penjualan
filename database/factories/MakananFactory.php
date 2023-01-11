<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penjualan>
 */
class MakananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_makanan' => $this->faker->sentence(1),
            'harga_makanan' => $this->faker->numberBetween($min = 2500, $max = 20000), // 8567
            'keterangan_makanan' => $this->faker->sentence(mt_rand(3,4)),
            'category_id' => mt_rand()
        ];
    }
    
}
