<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->products();

        Schema::enableForeignKeyConstraints();
    }

    /**
     * @return $this
     */
    protected function products()
    {
        Product::truncate();

        factory(Product::class, 10)->create();

        return $this;
    }
}