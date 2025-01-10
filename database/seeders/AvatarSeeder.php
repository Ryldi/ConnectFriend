<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Avatar;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avatar::create([
           'url' => 'chikorita.png',
           'price' => 100
        ]);

        Avatar::create([
            'url' => 'slowpoke.png',
            'price' => 10000
         ]);

        Avatar::create([
        'url' => 'blastoise.png',
        'price' => 100000
        ]);
    }
}
