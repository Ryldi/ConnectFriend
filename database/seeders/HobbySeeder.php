<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Hobby;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = [
            ['name' => 'Singing'],
            ['name' => 'Dancing'],
            ['name' => 'Painting'],
            ['name' => 'Photography'],
            ['name' => 'Reading'],
            ['name' => 'Writing'],
            ['name' => 'Cooking'],
            ['name' => 'Traveling'],
            ['name' => 'Gardening'],
            ['name' => 'Cycling'],
            ['name' => 'Swimming'],
            ['name' => 'Fishing'],
            ['name' => 'Yoga'],
            ['name' => 'Gaming'],
            ['name' => 'Knitting'],
            ['name' => 'Drawing'],
            ['name' => 'Running'],
            ['name' => 'Hiking'],
            ['name' => 'Camping'],
            ['name' => 'Horseback Riding'],
            ['name' => 'Baking'],
            ['name' => 'Juggling'],
            ['name' => 'Rock Climbing'],
            ['name' => 'Music Production'],
            ['name' => 'Collecting'],
            ['name' => 'Archery'],
            ['name' => 'Woodworking'],
            ['name' => 'DIY Projects'],
            ['name' => 'Bird Watching'],
            ['name' => 'Pottery'],
            ['name' => 'Astronomy'],
            ['name' => 'Sculpting'],
            ['name' => 'Fencing'],
            ['name' => 'Calligraphy'],
            ['name' => 'Magic Tricks'],
            ['name' => 'Pottery Making'],
            ['name' => 'Surfing'],
            ['name' => 'Skating'],
            ['name' => 'Public Speaking'],
            ['name' => 'Origami'],
            ['name' => 'Gardening'],
            ['name' => 'Geocaching'],
            ['name' => 'Stand-up Comedy'],
            ['name' => 'Wine Tasting'],
            ['name' => 'Birdwatching'],
        ];
        
        foreach ($hobbies as $hobby) {
            Hobby::create($hobby);
        }
    }
}
