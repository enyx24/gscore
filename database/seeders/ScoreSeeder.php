<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Running app:import-scores\n";
        $exit_code = Artisan::call('app:import-scores');
        echo "Import command finished with code $exit_code\n";
    }
}
