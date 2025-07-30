<?php

namespace Database\Seeders;

use App\Models\Ekstrakurikulers;
use App\Models\Kategoris;
use App\Models\Kelas;
use App\Models\Pelanggans;
use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'foto' => null
        ]);

        Profile::factory()->create();

        $kelass = [
            [
                'name' => 'X A',
            ],
            [
                'name' => 'X B',
            ],
            [
                'name' => 'X C',
            ],
            [
                'name' => 'XI A',
            ],
            [
                'name' => 'XI B',
            ],
            [
                'name' => 'XI C',
            ],
            [
                'name' => 'XII A',
            ],
            [
                'name' => 'XII B',
            ],
            [
                'name' => 'XII C',
            ],
        ];

        foreach ($kelass as $kelas) {
            Kelas::create($kelas);
        }

        $ekstrakurkulers = [
            [
                'name' => 'Pramuka',
            ],
            [
                'name' => 'Hadroh',
            ],
            [
                'name' => 'Desain',
            ],
            [
                'name' => 'Futsal',
            ],
            [
                'name' => 'Pubic Speaking',
            ],
        ];
        foreach ($ekstrakurkulers as $ekstrakurkulur) {
            Ekstrakurikulers::create($ekstrakurkulur);
        }
    }
}
