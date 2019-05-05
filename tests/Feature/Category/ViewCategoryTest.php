<?php

namespace Tests\Feature\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewCategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->category = create(Category::class);
    }

    /** @test */
    public function a_user_can_view_a_single_category()
    {
        $this->get(route('categories.show', $this->category))
            ->assertSee($this->category->title);
    }

    /** @test */
    public function a_user_can_view_product_that_are_associated_with_a_category()
    {
        $product = create(Product::class, ['category_id' => $this->category->id]);

        $this->get(route('categories.show', $this->category))
            ->assertSee($product->title);
    }
}