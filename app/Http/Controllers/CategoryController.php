<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var ICategoryRepository
     */
    protected $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
        return $this->categoryRepository->getWithChildren($id);
    }

    public function createCategory()
    {

    }
}
