<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PenugasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->sentence(3),
            'jenis' => $this->faker->randomElement(array('dalam kota','luar kota', 'luar provinsi', 'luar negeri')),
            'kategori' => $this->faker->randomElement(array('resmi', 'semi-resmi', 'non-resmi')),
            'tanggal' => $this->faker->date,
            'jumlah_asn' => $this->faker->randomDigit,
            'jumlah_outsourching' => $this->faker->randomDigit,
            'jumlah_titik_acara' => $this->faker->randomDigit,
            'tingkat_kesulitan' => $this->faker->randomElement(array('mudah', 'susah', 'sedang')),
        ];
    }
}
