<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->collection();
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     */
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $this->storeProduct($request->validated());
        if(isset($data['errors'])){
            return response()->json($data['errors'],400);
        }
        return response()->json($data,200);
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
    public function edit(string $id)
    {
        //
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
        return response()->json($data,200);
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
