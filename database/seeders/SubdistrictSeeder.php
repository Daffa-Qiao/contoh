<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubdistrictSeeder extends Seeder
{
    public function run(): void
    {
        $jakartaSubdistricts = [
            ['subdistrict_id' => 'JK01', 'name' => 'Cempaka Putih'],
            ['subdistrict_id' => 'JK02', 'name' => 'Gambir'],
            ['subdistrict_id' => 'JK03', 'name' => 'Johar Baru'],
            ['subdistrict_id' => 'JK04', 'name' => 'Kemayoran'],
            ['subdistrict_id' => 'JK05', 'name' => 'Menteng'],
            ['subdistrict_id' => 'JK06', 'name' => 'Sawah Besar'],
            ['subdistrict_id' => 'JK07', 'name' => 'Senen'],
            ['subdistrict_id' => 'JK08', 'name' => 'Tanah Abang'],
            ['subdistrict_id' => 'JK09', 'name' => 'Cakung'],
            ['subdistrict_id' => 'JK10', 'name' => 'Cilincing'],
            ['subdistrict_id' => 'JK11', 'name' => 'Kelapa Gading'],
            ['subdistrict_id' => 'JK12', 'name' => 'Koja'],
            ['subdistrict_id' => 'JK13', 'name' => 'Pademangan'],
            ['subdistrict_id' => 'JK14', 'name' => 'Penjaringan'],
            ['subdistrict_id' => 'JK15', 'name' => 'Tanjung Priok'],
            ['subdistrict_id' => 'JK16', 'name' => 'Grogol Petamburan'],
            ['subdistrict_id' => 'JK17', 'name' => 'Kalideres'],
            ['subdistrict_id' => 'JK18', 'name' => 'Kebon Jeruk'],
            ['subdistrict_id' => 'JK19', 'name' => 'Kembangan'],
            ['subdistrict_id' => 'JK20', 'name' => 'Palmerah'],
            ['subdistrict_id' => 'JK21', 'name' => 'Taman Sari'],
            ['subdistrict_id' => 'JK22', 'name' => 'Tambora'],
            ['subdistrict_id' => 'JK23', 'name' => 'Cilandak'],
            ['subdistrict_id' => 'JK24', 'name' => 'Jagakarsa'],
            ['subdistrict_id' => 'JK25', 'name' => 'Kebayoran Baru'],
            ['subdistrict_id' => 'JK26', 'name' => 'Kebayoran Lama'],
            ['subdistrict_id' => 'JK27', 'name' => 'Mampang Prapatan'],
            ['subdistrict_id' => 'JK28', 'name' => 'Pancoran'],
            ['subdistrict_id' => 'JK29', 'name' => 'Pasar Minggu'],
            ['subdistrict_id' => 'JK30', 'name' => 'Pesanggrahan'],
            ['subdistrict_id' => 'JK31', 'name' => 'Setiabudi'],
            ['subdistrict_id' => 'JK32', 'name' => 'Tebet'],
            ['subdistrict_id' => 'JK33', 'name' => 'Cipayung'],
            ['subdistrict_id' => 'JK34', 'name' => 'Ciracas'],
            ['subdistrict_id' => 'JK35', 'name' => 'Duren Sawit'],
            ['subdistrict_id' => 'JK36', 'name' => 'Jatinegara'],
            ['subdistrict_id' => 'JK37', 'name' => 'Kramat Jati'],
            ['subdistrict_id' => 'JK38', 'name' => 'Makasar'],
            ['subdistrict_id' => 'JK39', 'name' => 'Matraman'],
            ['subdistrict_id' => 'JK40', 'name' => 'Pasar Rebo'],
            ['subdistrict_id' => 'JK41', 'name' => 'Pulo Gadung'],
        ];
        foreach ($jakartaSubdistricts as $sd) {
            DB::table('subdistricts')->insert($sd);
        }
    }
} 