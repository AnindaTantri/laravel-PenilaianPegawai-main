<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'jabatan' => $this->faker->randomElement(array('dantim','personil')),
            'status' => $this->faker->randomElement(array('asn', 'outsourching')),
            'jumlah_dinas' => $this->faker->randomDigit,
            'nilai_dinas' => $this->faker->randomDigit,
            'administrasi' => $this->faker->randomElement(array('sudah', 'belum')),
            'kekuatan' => $this->faker->randomElement(array('mudah', 'susah', 'sedang')),
            'jenis_kelamin' => $this->faker->randomElement(array('L', 'P')),
        ];
    }
}
