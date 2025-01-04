<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ProductTrait;


class ProductController extends Controller
{
    use ProductTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->collection();
        if(isset($products['errors'])){
            return response()->json($products['errors'],400);
        }
        return  view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $this->storeProduct($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->resource($id);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id,ProductRequest $request)
    {
        $data = $this->updateProduct($id,$request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $data = $this->delete($id);
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }
   
}
