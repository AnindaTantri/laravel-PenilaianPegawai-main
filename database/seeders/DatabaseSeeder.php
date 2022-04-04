<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Penugasan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Pegawai::factory(20)->create();
        Penugasan::factory(20)->create();
        User::factory(1)->create();
    }
}
