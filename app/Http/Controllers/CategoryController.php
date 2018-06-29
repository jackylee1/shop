<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var ICategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var IProductRepository
     */
    protected $productRepository;

    public function __construct(ICategoryRepository $categoryRepository, IProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function getCategories()
    {
        return view('category.all');
    }

    public function getCategory($id)
    {
        // TODO: Проверить на существование

        return view('category.info', compact('id'));
    }

    public function getCategoriesJson()
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryJson($id)
    {
        // TODO: Проверить на существование

        return $this->categoryRepository->getProducts($id, $this->productRepository);
    }

    public function createCategory()
    {

    }
}
