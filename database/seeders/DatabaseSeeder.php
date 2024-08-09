<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Table;
use App\Models\DiningArea;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::transaction(function () {
            $indoor = DiningArea::create(['name' => 'Indoor']);
            $outdoor = DiningArea::create(['name' => 'Outdoor']);
            $outdoorTerrace = DiningArea::create(['name' => 'Outdoor Terrace']);

            $greenRestaurant = Restaurant::create(['name' => 'Green Restaurant']);
            $blueRestaurant = Restaurant::create(['name' => 'Blue Restaurant']);

            $greenRestaurant->tables()->createMany([
                ['name' => 'Table 1', 'minimum_capacity' => 2, 'maximum_capacity' => 4, 'active' => true, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 2', 'minimum_capacity' => 2, 'maximum_capacity' => 4, 'active' => true, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 3', 'minimum_capacity' => 2, 'maximum_capacity' => 4, 'active' => true, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 4', 'minimum_capacity' => 2, 'maximum_capacity' => 4, 'active' => true, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 5', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => false, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 6', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => false, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 7', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => true, 'dining_area_id' => $outdoor->id],
                ['name' => 'Table 8', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => true, 'dining_area_id' => $outdoor->id],
                ['name' => 'Table 9', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => true, 'dining_area_id' => $outdoor->id],
                ['name' => 'Table 10', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => true, 'dining_area_id' => $outdoor->id],
                ['name' => 'Table 11', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => true, 'dining_area_id' => $outdoor->id],
            ]);

            $blueRestaurant->tables()->createMany([
                ['name' => 'Table 12', 'minimum_capacity' => 1, 'maximum_capacity' => 2, 'active' => true, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 13', 'minimum_capacity' => 1, 'maximum_capacity' => 2, 'active' => true, 'dining_area_id' => $indoor->id],
                ['name' => 'Table 14', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => true, 'dining_area_id' => $outdoorTerrace->id],
                ['name' => 'Table 15', 'minimum_capacity' => 3, 'maximum_capacity' => 5, 'active' => true, 'dining_area_id' => $outdoorTerrace->id],
            ]);
        });
    }
}
