<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subsubcategory_name_en',
        'subsubcategory_name_id',
        'subsubcategory_slug_en',
        'subsubcategory_slug_id',
        'category_id',
        'subcategory_id',
        'last_updated_by'
    ];

    public function admin(){
        return $this->hasOne(Admin::class, 'id', 'last_updated_by');
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function subcategory(){
        return $this->hasOne(SubCategory::class, 'id', 'subcategory_id');
    }
}
