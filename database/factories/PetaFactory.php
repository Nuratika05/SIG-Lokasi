<?php

namespace Database\Factories;

use App\Models\Peta;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Peta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'nomor' => $this->faker->word,
        'keterangan' => $this->faker->word,
        'jenis_lokasi' => $this->faker->word,
        'x' => $this->faker->word,
        'y' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
