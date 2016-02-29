<?php

namespace App\Http\Controllers;

use App\Src\Category\Category;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param Category $categoryRepository
     */
    public function __construct(Category $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->with(['companies'])->get();
        return response()->json(['data'=>$categories]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * Show Category With the List of Companies and the thumbnails
     */
    public function show($id)
    {
        $category = $this->categoryRepository->with(['companies'])->find($id);
        return response()->json(['data'=>$category]);
    }

}
