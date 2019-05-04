<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDefaultUser()
            ->call(SampleDataSeeder::class);
    }

    /**
     * @return $this
     */
    protected function createDefaultUser()
    {
        factory(\App\Models\User::class)->create([
            'email' => 'admin@evention.com',
        ]);

        return $this;
    }
}
