<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Event;
use App\Models\Building;
use App\Models\Application;
use App\Models\Development;
use App\Models\BuildingImage;
use App\Models\MosqueHistory;
use App\Models\MosqueHistoryImage;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory(50)->create();
        Building::factory(60)->create();
        Building::all()->each(function($building) {
            BuildingImage::factory(random_int(1, 5))->create([
                'building_id' => $building->id,
            ]);
        });
        MosqueHistory::factory(50)->create();
        MosqueHistory::all()->each(function($mosqueHistory) {
            MosqueHistoryImage::factory(random_int(1, 5))->create([
                'mosque_history_id' => $mosqueHistory->id,
            ]);
        });
        Application::factory(50)->create();
        Achievement::factory(15)->create();
        Review::factory(20)->create();
    }
}
