<?php

namespace Database\Seeders;

use App\Models\UserHobby;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 7; $i++) { 
            for ($j=0; $j < 3; $j++) { 
                UserHobby::create([
                    'user_id' => ($i+1),
                    'hobby_id' => rand(1, 45)
                ]);
            }
        }
    }
}
