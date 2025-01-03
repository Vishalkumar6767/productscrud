<?php

namespace App\Traits;

use App\Models\Attachment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait AttachmentTrait
{
    protected  $productObject;

    public function __construct(Product $productObject){
        $this->productObject  = $productObject;

    }
    public function storeAttachments($id,$inputs)
    {
        
       
        try {
            
           

            $product =$this->productObject->findOrFail($id);
                $file = $inputs['attachments'];
                    $attachmentName = Str::uuid() . '.' . $file->getClientOriginalExtension(); 
                    $path = 'storage/assets/attachments/' . $attachmentName; 
                     $file->storeAs('public/assets/attachments', $attachmentName); 
                    DB::beginTransaction();
                    $product->attachments()->create([
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => $attachmentName, 
                        'folder_name' => 'attachments',
                    ]);
                
            

            DB::commit();

            return [
                'status' => true,
                'link'=>asset('storage/assets/attachments/'.$attachmentName),
                'message' => 'Attachments saved successfully',
                'data' => $product->load('attachments'),
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Failed to add Attachments. Please try again.',
                'error' => $e->getMessage(), 
                'code' => 500,
            ];
        }
    }

    public function updateAttachments(int $id, $inputs)

    {
        
        $data= Attachment::findOrFail($id);
      
        if ($inputs['attachments']) {
            if ($data->attachments && Storage::exists('public/assets/' . $data->attachments)) {
                Storage::delete('public/assets/' . $data->attachments);
            }
    
            $attachmentName = time() . '.' . $inputs['attachments']->getClientOriginalExtension();
            $inputs['attachments']->storeAs('public/assets', $attachmentName);
        } else {
            $attachmentName = $data->attachments;
        }
       
        $data->update([
            'original_name' => $inputs['attachments']->getClientOriginalExtension(),
            'stored_name' => $attachmentName, 
            'folder_name' => 'attachments',
        ]);
    
        return $data;
    }
    
    
    public function deleteAttachments($id)
    {
       
        $data = Attachment::findOrFail($id);
        $data->delete();
        $success['message'] = "Data deleted successfully";
        return $success;
    }
}

