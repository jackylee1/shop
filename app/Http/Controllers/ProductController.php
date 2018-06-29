<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var IProductRepository
     */
    protected $productRepository;

    /**
     * @var ICategoryRepository
     */
    protected $categoryRepository;

    public function __construct(IProductRepository $productRepository, ICategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function createProduct()
    {
        $this->productRepository->create([
            'category_id' => 6,
            'name' => "Samsung Galaxy S9",
            'url' => "galaxys9samsung",
            'image_url' => "https://cdn.27.ua/190/f0/e7/585959_6.jpeg",
            'status' => 1,
            'price' => 19000,
            'description' => "Samsung phone",
        ]);
    }
}
