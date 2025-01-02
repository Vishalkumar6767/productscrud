<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'name',
        'category_id',
        'sub_category_id',
        'cost',
        'price'

    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

}
