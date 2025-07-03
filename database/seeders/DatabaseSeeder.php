<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(SubdistrictSeeder::class);

        // Ambil id subdistrict untuk user
        $subdistrictDokter = \DB::table('subdistricts')->where('name', 'Cempaka Putih')->first();
        $subdistrictAdmin = \DB::table('subdistricts')->where('name', 'Gambir')->first();
        $subdistrictPasien = \DB::table('subdistricts')->where('name', 'Menteng')->first();

        // Seeder user role dokter
        \App\Models\User::factory()->create([
            'name' => 'Dokter Satu',
            'email' => 'dokter@example.com',
            'password' => bcrypt('password'),
            'role' => 'dokter',
            'subdistrict_id' => $subdistrictDokter ? $subdistrictDokter->id : 1,
        ]);
        // Seeder user role admin
        \App\Models\User::factory()->create([
            'name' => 'Admin Satu',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'subdistrict_id' => $subdistrictAdmin ? $subdistrictAdmin->id : 1,
        ]);
        // Seeder user role pasien
        \App\Models\User::factory()->create([
            'name' => 'Pasien Satu',
            'email' => 'pasien@example.com',
            'password' => bcrypt('password'),
            'role' => 'pasien',
            'subdistrict_id' => $subdistrictPasien ? $subdistrictPasien->id : 1,
        ]);
    }
}
