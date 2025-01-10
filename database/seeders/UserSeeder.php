<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Smith',
            'gender' => 'Male',
            'dob' => '1995-03-15',
            'mobile_number' => '081234567890',
            'instagram' => 'https://www.instagram.com/johnsmith',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Emma Wilson',
            'gender' => 'Female',
            'dob' => '1997-07-22',
            'mobile_number' => '081234567891',
            'instagram' => 'https://www.instagram.com/emmawilson',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Michael Chen',
            'gender' => 'Male',
            'dob' => '1993-11-30',
            'mobile_number' => '081234567892',
            'instagram' => 'https://www.instagram.com/michaelchen',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Sarah Johnson',
            'gender' => 'Female',
            'dob' => '1996-05-18',
            'mobile_number' => '081234567893',
            'instagram' => 'https://www.instagram.com/sarahjohnson',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'David Kim',
            'gender' => 'Male',
            'dob' => '1994-09-25',
            'mobile_number' => '081234567894',
            'instagram' => 'https://www.instagram.com/davidkim',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Lisa Garcia',
            'gender' => 'Female',
            'dob' => '1998-01-12',
            'mobile_number' => '081234567895',
            'instagram' => 'https://www.instagram.com/lisagarcia',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'James Wilson',
            'gender' => 'Male',
            'dob' => '1992-04-08',
            'mobile_number' => '081234567896',
            'instagram' => 'https://www.instagram.com/jameswilson',
            'password' => Hash::make('password123')
        ]);

    }
}
