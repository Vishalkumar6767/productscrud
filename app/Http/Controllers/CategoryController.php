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
        $data = $this->collection();
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
        
    }

    public function store(CategoryRequest $request)
    {
        $data = $this->storeCategory($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }

   
    public function show(Category $category)
    {
       
    }

  
    public function update(int $id, CategoryRequest $request)
    {
        $data = $this->updateCategory($id, $request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
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
