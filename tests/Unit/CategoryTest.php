<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
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
    public function a_category_has_slug()
    {
        $this->assertEquals(Str::slug($this->category->title), $this->category->slug);
    }

    /** @test */
    public function a_cateogry_has_unique_slug()
    {
        $category = create(Category::class, [
            'title' => $this->category->title,
        ]);

        $this->assertEquals(Str::slug($category->title) . '-' . $category->id, $category->slug);

        $this->assertEquals(Str::slug($this->category->title), $this->category->slug);
    }

    /** @test */
    public function a_category_has_products()
    {
        $this->assertInstanceOf(Collection::class, $this->category->products);
    }

    /** @test */
    public function a_category_has_properties()
    {
        $this->assertInstanceOf(Collection::class, $this->category->properties);
    }

    /** @test */
    public function a_category_has_a_parent_category()
    {
        $parent = create(Category::class);

        $this->category->update(['parent_id' => $parent->id]);

        $this->assertInstanceOf(Category::class, $this->category->parent);
    }

    /** @test */
    public function a_category_has_children_categories()
    {
        $this->assertInstanceOf(Collection::class, $this->category->children);
    }

    /** @test */
    public function a_category_can_be_a_parent_category()
    {
        create(Category::class, [
            'parent_id' => $this->category->id,
        ]);

        $this->assertTrue($this->category->isParent());
    }

    /** @test */
    public function a_category_can_be_children_categories()
    {
        $parent = create(Category::class);

        $this->category->update(['parent_id' => $parent->id]);

        $this->assertTrue($this->category->isChild());
    }

    /** @test */
    public function a_cateogry_has_children_categories()
    {
        create(Category::class, [
            'parent_id' => $this->category->id,
        ]);

        $this->assertCount(1, $this->category->children);
    }
}
