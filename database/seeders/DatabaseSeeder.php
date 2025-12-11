<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('trade_turnovers')->truncate();
        DB::table('economies')->truncate();
        DB::table('events')->truncate();
        DB::table('countries')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Countries
        DB::table('countries')->insert([
            ['id' => 1, 'name' => 'USA', 'capital' => 'Washington, D.C.', 'population' => 331002651, 'area' => 9833520.0],
            ['id' => 2, 'name' => 'China', 'capital' => 'Beijing', 'population' => 1439323776, 'area' => 9596961.0],
            ['id' => 3, 'name' => 'Russia', 'capital' => 'Moscow', 'population' => 145934462, 'area' => 17098242.0],
            ['id' => 4, 'name' => 'Germany', 'capital' => 'Berlin', 'population' => 83783942, 'area' => 357022.0],
            ['id' => 5, 'name' => 'Japan', 'capital' => 'Tokyo', 'population' => 126476461, 'area' => 377975.0],
        ]);

        // 2. Events (Original + Extra)
        DB::table('events')->insert([
            // Original
            ['country_id' => 1, 'description' => 'Presidential Election', 'date' => '2020-11-03'],
            ['country_id' => 2, 'description' => 'Winter Olympics Opening', 'date' => '2022-02-04'],
            ['country_id' => 3, 'description' => 'FIFA World Cup Hosting', 'date' => '2018-06-14'],
            ['country_id' => 4, 'description' => 'Reunification Day Celebration', 'date' => '2023-10-03'],
            ['country_id' => 1, 'description' => 'Winter Olympics Opening', 'date' => '2024-11-03'], // Wait, this was int the SQL?
            ['country_id' => 5, 'description' => 'Tokyo Olympics Opening', 'date' => '2021-07-23'],
            ['country_id' => 4, 'description' => 'Reunification Day Celebration', 'date' => '2025-10-03'],
            
            // New Extra Data for demonstration
            ['country_id' => 1, 'description' => 'Super Bowl LVIII', 'date' => '2024-02-11'],
            ['country_id' => 1, 'description' => 'Independence Day Parade', 'date' => '2024-07-04'],
            ['country_id' => 1, 'description' => 'Tech Summit Silicon Valley', 'date' => '2024-09-15'],
            ['country_id' => 4, 'description' => 'Oktoberfest 2024', 'date' => '2024-09-21'],
            ['country_id' => 4, 'description' => 'Berlin Film Festival', 'date' => '2024-02-15'],
        ]);

        // 3. Economies
        DB::table('economies')->insert([
            // Original
            ['country_id' => 1, 'year' => 2022, 'gdp' => 25462.7, 'gdp_per_capita' => 76398.0],
            ['country_id' => 2, 'year' => 2022, 'gdp' => 17963.2, 'gdp_per_capita' => 12720.0],
            ['country_id' => 3, 'year' => 2022, 'gdp' => 2240.4, 'gdp_per_capita' => 15345.0],
            ['country_id' => 4, 'year' => 2022, 'gdp' => 4072.2, 'gdp_per_capita' => 48432.0],
            ['country_id' => 5, 'year' => 2022, 'gdp' => 4231.1, 'gdp_per_capita' => 33815.0],
            ['country_id' => 1, 'year' => 2023, 'gdp' => 12340.6, 'gdp_per_capita' => 76300.0],
            ['country_id' => 2, 'year' => 2023, 'gdp' => 17960.2, 'gdp_per_capita' => 12720.0],
            ['country_id' => 3, 'year' => 2023, 'gdp' => 2240.4, 'gdp_per_capita' => 15300.0],
            ['country_id' => 4, 'year' => 2023, 'gdp' => 4070.2, 'gdp_per_capita' => 48400.0],
            ['country_id' => 5, 'year' => 2023, 'gdp' => 4230.1, 'gdp_per_capita' => 33800.0],

            // New Extra Data
            ['country_id' => 1, 'year' => 2020, 'gdp' => 21060.5, 'gdp_per_capita' => 63500.0],
            ['country_id' => 1, 'year' => 2021, 'gdp' => 23315.1, 'gdp_per_capita' => 70200.0],
        ]);

        // 4. Trade Turnovers
        DB::table('trade_turnovers')->insert([
            // Original
            ['country_id1' => 1, 'country_id2' => 2, 'year' => 2022, 'export_c1_to_c2' => 153.8, 'export_c2_to_c1' => 536.8],
            ['country_id1' => 1, 'country_id2' => 4, 'year' => 2022, 'export_c1_to_c2' => 70.0, 'export_c2_to_c1' => 140.0],
            ['country_id1' => 2, 'country_id2' => 3, 'year' => 2022, 'export_c1_to_c2' => 76.1, 'export_c2_to_c1' => 114.1],
            ['country_id1' => 3, 'country_id2' => 4, 'year' => 2022, 'export_c1_to_c2' => 30.0, 'export_c2_to_c1' => 25.0],
            ['country_id1' => 5, 'country_id2' => 1, 'year' => 2022, 'export_c1_to_c2' => 140.0, 'export_c2_to_c1' => 80.0],

            // New Extra Data
            ['country_id1' => 4, 'country_id2' => 5, 'year' => 2023, 'export_c1_to_c2' => 20.5, 'export_c2_to_c1' => 18.2],
            ['country_id1' => 2, 'country_id2' => 4, 'year' => 2023, 'export_c1_to_c2' => 150.0, 'export_c2_to_c1' => 100.0],
        ]);
    }
}
