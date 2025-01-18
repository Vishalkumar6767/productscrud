<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Traits\CategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // use CategoryTrait;
    protected $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->collection();
        if(isset($categories['errors'])){
            return response()->json($categories['errors'],400);
        }
        return  view('categories.index', compact('categories'));
        
    }

    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $this->categoryService->store($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('categories.index');
    }

   
    public function show(int $id)
    {
        $data = $this->categoryService->resource($id);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data, 200);
       
    }

       
    

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

  
    public function update(int $id, CategoryRequest $request)
    {
        $data = $this->categoryService->update($id, $request->validated());
        if(isset($data['errors'])){
            return view('errors.error', ['errors' => $data['errors']]);
        }
        return redirect()->route('categories.index');
    }

   
    public function destroy(int $id)
    {
        $data = $this->categoryService->delete($id);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }
}
