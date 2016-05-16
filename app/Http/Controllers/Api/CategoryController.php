<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Src\Category\Category;
use Illuminate\Support\Facades\Auth;

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
        $categories = $this->categoryRepository->get();
        return response()->json(['data'=>$categories]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * Show Category With the List of Companies and the thumbnails
     */
    public function show($id)
    {
        $userID = Auth::guard('api')->user() ? Auth::guard('api')->user()->id  :'0';
        $category = $this->categoryRepository->with(['companies.favorites'])->find($id);
        $category->companies->map(function($company) use ($userID) {
            if ($company->favorites->contains($userID)) {
                $company->isFavorited = true;
            } else {
                $company->isFavorited = false;
            }
        });
        return response()->json(['data'=>$category]);

    }

}
