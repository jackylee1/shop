<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ImageTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->image = create(Image::class);
    }

    /** @test */
    public function a_image_belongs_to_a_product()
    {
        $this->assertInstanceOf(Product::class, $this->image->product);
    }

    /** @test */
    public function a_image_can_be_a_cover()
    {
        $this->assertTrue($this->image->is_cover);
    }
}
