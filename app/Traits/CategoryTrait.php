<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

trait CategoryTrait
{
    public function collection(){
        $data = Category::get()->all();
        return $data;


    }
    public function storeCategory($inputs){
        try {
            DB::beginTransaction();
            $category = Category::create([
                'name' => $inputs['name'],
                'short_name' => $inputs['category_id'],
                'parent_id' => $inputs['parent_id'],
                
            ]);
    
            
            DB::commit();
    
            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            $data['errors'] =[
                'status' => false,
                'message' => 'failed to Add Category Data. Please try again.',
                'error' => $e->getMessage(),
                'code' => 500,
            ];
            return $data;
        }
    
    }
    public function resource(int $id){
        $category = Category::findOrFail($id);
    
        return $category;
    
    }
    public function updateCategory($id, $inputs){
        $category = Category::findOrFail($id);
        try {
            DB::beginTransaction();
       
        $category->update([
            'name'      => $inputs['name'],
            'short_name'     => $inputs['category_id'],
            'parent_id'     => $inputs['parent_id'],
           
           
    
        ]);
        DB::commit();
        $success['message'] = "Data updated successfully";
        return $success;
    } catch (\Exception $e) {
        DB::rollBack();
        $data['errors'] =[
            'status' => false,
            'message' => 'failed to Update category Data. Please try again.',
            'error' => $e->getMessage(),
            'code' => 500,
        ];
        return $data;
    }
        
    }
    
    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete($id);
        $success['message'] = "Data deleted successfully";
        return $success;
    
    }
    
}
