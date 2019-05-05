<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductTest extends TestCase
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
    public function a_product_has_reviews()
    {
        $this->assertInstanceOf(Collection::class, $this->product->reviews);
    }

    /** @test */
    public function a_product_has_images()
    {
        $this->assertInstanceOf(Collection::class, $this->product->images);
    }

    /** @test */
    public function a_product_belongs_to_a_category()
    {
        $this->assertInstanceOf(Category::class, $this->product->category);
    }

    /** @test */
    public function a_product_has_properties()
    {
        $this->assertInstanceOf(Collection::class, $this->product->properties);
    }

    /** @test */
    public function a_product_has_a_bookmark_status()
    {
        $this->assertIsBool($this->product->hasBookmark());
    }

    /** @test */
    public function a_product_has_slug()
    {
        $this->assertEquals(Str::slug($this->product->title), $this->product->slug);
    }

    /** @test */
    public function a_product_has_unique_slug()
    {
        $product = create(Product::class, [
            'title' => $this->product->title,
        ]);

        $this->assertEquals(Str::slug($product->title) . '-' . $product->id, $product->slug);

        $this->assertEquals(Str::slug($this->product->title), $this->product->slug);
    }

    /** @test */
    public function a_product_has_cover()
    {
        $this->assertNull($this->product->cover);

        $image = create(Image::class, [
            'product_id' => $this->product->id,
            'is_cover' => true,
        ]);

        $this->assertEquals($image->path, $this->product->cover);
    }
}
