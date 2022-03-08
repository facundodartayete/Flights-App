<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Flight;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $airlines = Airline::factory(20)
            ->has(City::factory()->count(5))
            ->create();

        for ($i = 0; $i < rand(40, 100); $i++) {
            $airline = $airlines->random();
            $cities = $airline->cities()->get();
            $origin = $cities->random();
            $destination = collect($cities)->where('id', '!=',  $origin->id)->random();
            if ($origin->id != $destination->id)
                Flight::factory()->create([
                    'airline_id' => $airline->id,
                    'origin_city_id' => $origin->id,
                    'destination_city_id' => $destination->id,
                ]);
        }
    }
}
