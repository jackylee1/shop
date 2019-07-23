<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Review::class, function (Faker $faker, $arguments = []) {
    return [
        'product_id' => $arguments['product_id'] ?? factory(\App\Models\Product::class)->create()->id,
        'status' => \App\Models\Review::STATUS_PUBLISHED,
        'user_id' => factory(\App\Models\User\User::class)->create()->id,
        'user_name' => $faker->unique()->name,
        'text' => $faker->text,
    ];
});
