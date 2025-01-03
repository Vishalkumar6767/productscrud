<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

trait ProductTrait
{
public function collection(){
    $product = Product:: with('attachments','category','subCategory')->get();
   
    return $product;

}
public function storeProduct($inputs){
    try {
        DB::beginTransaction();
        $product = Product::create([
            'name' => $inputs['name'],
            'category_id' => $inputs['category_id'],
            'sub_category_id' => $inputs['sub_category_id'],
            'cost' => $inputs['cost'],
            'price'=> $inputs['price']
        ]);

        
        DB::commit();

        return $product;
    } catch (\Exception $e) {
        DB::rollBack();
        $data['errors'] =[
            'status' => false,
            'message' => 'failed to Add Product Data. Please try again.',
            'error' => $e->getMessage(),
            'code' => 500,
        ];
        return $data;
    }

}
public function resource(int $id){
    $product = Product::findOrFail($id);

    return $product;

}
public function updateProduct($id, $inputs){
    $product = Product::findOrFail($id);
    try {
        DB::beginTransaction();
   
    $product->update([
        'name'      => $inputs['name'],
        'category_id'     => $inputs['category_id'],
        'sub_category_id'     => $inputs['sub_category_id'],
        'cost'     => $inputs['cost'],
        'price'    => $inputs['price'],
       

    ]);
    DB::commit();
    $success['message'] = "Data updated successfully";
    return $success;
} catch (\Exception $e) {
    DB::rollBack();
    $data['errors'] =[
        'status' => false,
        'message' => 'failed to Update Product Data. Please try again.',
        'error' => $e->getMessage(),
        'code' => 500,
    ];
    return $data;
}
    
}

public function delete($id){
    $product = Product::findOrFail($id);
    $product->delete($id);
    $success['message'] = "Data deleted successfully";
    return $success;

}

}



