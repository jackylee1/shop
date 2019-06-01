<?php

use Evention\Database\Seeds\Seeder;
use Evention\Database\Seeds\SettingsSeeder;
use Evention\Database\Seeds\SampleDataSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('installing')) {
            $this->call(SettingsSeeder::class);
        } else {
            $this->createDefaultUser()
                ->call(SampleDataSeeder::class);
        }
    }
}
