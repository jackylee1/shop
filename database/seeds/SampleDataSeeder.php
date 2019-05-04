<?php

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->reviews();

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

    /**
     * @return $this
     */
    protected function reviews()
    {
        Review::truncate();

        factory(Review::class, 10)->create();

        return $this;
    }
}