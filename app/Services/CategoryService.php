<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    protected $categoryObject;
    public function __construct()
    {
        $this->categoryObject = new Category;

    }

    public function collection(){
        $data = Category::get()->all();
        return $data;


    }
    public function store($inputs){
        try {
            DB::beginTransaction();
            $category = $this->categoryObject->create([
                'name' => $inputs['name'],
                'short_name' => $inputs['short_name'],
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
        $category = $this->categoryObject->findOrFail($id);
    
        return $category;
    
    }
    public function update($id, $inputs){
        $category = $this->categoryObject->findOrFail($id);
        try {
            DB::beginTransaction();
       
        $category->update([
            'name'      => $inputs['name'],
            'short_name'     => $inputs['short_name'],
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
        $category =$this->categoryObject->findOrFail($id);
        $category->delete($id);
        $success['message'] = "Data deleted successfully";
        return $success;
    
    }
}
