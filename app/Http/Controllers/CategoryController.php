<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\CategoryTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CategoryTrait;

    public function index()
    {
        $categories = $this->collection();
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
        $data = $this->storeCategory($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('categories.index');
    }

   
    public function show(Category $category)
    {
       
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

  
    public function update(int $id, CategoryRequest $request)
    {
        $data = $this->updateCategory($id, $request->validated());
        if(isset($data['errors'])){
            return view('errors.error', ['errors' => $data['errors']]);
        }
        return redirect()->route('categories.index');
    }

   
    public function destroy(int $id)
    {
        $data = $this->delete($id);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }
}
