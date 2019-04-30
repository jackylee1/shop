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
        $this->createDefaultUser();
    }

    /**
     * @return $this
     */
    protected function createDefaultUser()
    {
        factory(\App\Models\User::class)->create();

        return $this;
    }
}
