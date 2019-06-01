<?php

namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewProductTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->product = create(Product::class);
    }

    /** @test */
    public function a_user_can_view_all_product()
    {
        $this->get('/')
            ->assertSee($this->product->title);
    }

    /** @test */
    public function a_user_can_view_a_single_product()
    {
        $this->get(route('products.show', $this->product))
            ->assertSee($this->product->title);
    }

    /** @test */
    public function a_user_can_read_reviews_that_are_associated_with_a_product()
    {
        $review = create(Review::class, ['product_id' => $this->product->id]);

        $this->get(route('products.show', $this->product))
            ->assertSee($review->text);
    }
}
