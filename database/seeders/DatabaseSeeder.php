<?php

namespace Database\Seeders;

use App\Models\Akses;
use App\Models\User;
use App\Models\Makanan;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Category::factory(7)->create();
        Makanan::factory(15)->create();
        // Akses::factory(2)->create();



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Akses::factory()->create([
        //     'nama_akses' => 'Admin',
        //     'deskripsi_akses' => 'Admin atau owner',
        // ]);
        // Akses::factory()->create([
        //     'nama_akses' => 'Kasir',
        //     'deskripsi_akses' => 'Kasir',
        // ]);
    }
}
