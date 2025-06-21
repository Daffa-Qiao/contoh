<?php

namespace Database\Seeders;

use App\Models\Subdistrict;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banyumanik = Subdistrict::where('name', 'like', 'Banyumanik')->first();
        User::create([
            "name" => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('admin'), // password
            'phone' => "08921118322912",
            'photo' => 'https://placehold.co/600x400?text=User+Photo',
            'subdistrict_id' => $banyumanik->id
        ])->assignRole('admin');

        User::factory(10)->create();
    }
}
