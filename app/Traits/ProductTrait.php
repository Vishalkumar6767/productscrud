<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ProductTrait
{
public function collection($inputs){
    $query = Product::query();   
    if (!empty($inputs['search'])) {
        $search = $inputs['search'];
        $query->where('name', 'like', "%{$search}%")
              ->orWhereHas('category', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('subCategory', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
    }
    $products = $query->with(['category', 'subCategory', 'attachments'])->get();
    return $products; 
}
public function storeProduct($inputs)
{
    try {
        DB::beginTransaction();
        // Create the product
        $product = Product::create([
            'name' => $inputs['name'],
            'category_id' => $inputs['category_id'],
            'sub_category_id' => $inputs['sub_category_id'],
            'cost' => $inputs['cost'],
            'price' => $inputs['price'],
        ]);

        // Handle attachments if present
        if (is_array($inputs['attachments'])) {
            foreach ($inputs['attachments'] as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $attachmentName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/assets/attachments', $attachmentName);
        
                    $product->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => $attachmentName,
                        'folder_name' => 'attachments',
                    ]);
                }
            }
        } else {
             $data =[
                'status' => false,
                'message' => 'Invalid file input.',
            ];
            return $data;
        }
        

        DB::commit();

        $data = [
            'status' => true,
            'message' => 'Product and attachments saved successfully.',
            'data' => $product->load('attachments'),
        ];
      
        return $data;

    } catch (\Exception $e) {
        DB::rollBack();

         $data =[
            'status' => false,
            'message' => 'Failed to save product or attachments. Please try again.',
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
public function updateProduct($id, $inputs)
{
    $product = Product::findOrFail($id);
    
    try {
        DB::beginTransaction();

        // Update the product details
        $product->update([
            'name' => $inputs['name'],
            'category_id' => $inputs['category_id'],
            'sub_category_id' => $inputs['sub_category_id'],
            'cost' => $inputs['cost'],
            'price' => $inputs['price'],
        ]);

        // Handle attachments if provided
        if (isset($inputs['attachments']) && is_array($inputs['attachments'])) {
            $existingAttachments = $product->attachments->pluck('stored_name')->toArray();
            $newAttachments = [];
            foreach ($inputs['attachments'] as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $attachmentName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/assets/attachments', $attachmentName);
                    $product->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => $attachmentName,
                        'folder_name' => 'attachments',
                    ]);
                    $newAttachments[] = $attachmentName;
                }
            }
            $attachmentsToDelete = array_diff($existingAttachments, $newAttachments);
            foreach ($attachmentsToDelete as $attachmentName) {
                $attachment = $product->attachments()->where('stored_name', $attachmentName)->first();
                if ($attachment) {
                  
                    Storage::delete('public/assets/attachments/' . $attachmentName);
                    $attachment->delete();
                }
            }
        }

        DB::commit();

        return [
            'status' => true,
            'message' => 'Product and attachments updated successfully.',
            'data' => $product->load('attachments'),
        ];

    } catch (\Exception $e) {
        DB::rollBack();

        return [
            'status' => false,
            'message' => 'Failed to update product or attachments. Please try again.',
            'error' => $e->getMessage(),
            'code' => 500,
        ];
    }
}

public function delete($id)
{
    $product = Product::findOrFail($id);

    try {
        DB::beginTransaction();
        foreach ($product->attachments as $attachment) {
            Storage::delete('public/assets/attachments/' . $attachment->stored_name);
            
            // Delete the attachment record from the database
            $attachment->delete();
        }

        // Delete the product
        $product->delete();

        DB::commit();

        return [
            'status' => true,
            'message' => 'Product and its attachments deleted successfully.',
        ];

    } catch (\Exception $e) {
        DB::rollBack();

        return [
            'status' => false,
            'message' => 'Failed to delete product and its attachments. Please try again.',
            'error' => $e->getMessage(),
        ];
    }
}

}




